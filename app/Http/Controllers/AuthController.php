<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\SetNewPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use HelperTrait;

    public function login(LoginRequest $request): JsonResponse|RedirectResponse
    {
        return $this->auth($request, false);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        if (RateLimiter::tooManyAttempts('register:'.request('email'), $perMinute = 5))
            return response()->json(['message' => trans('errors.to_many_attempts')],429);

        $credentials = $request->validated();
        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);

        event(new Registered($user));
//        auth()->login($user);

        return response()->json(['message' => trans('auth.check_your_mail')],200);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return response()->json(['message' => trans($status)], 200);
    }

    public function setNewPassword(SetNewPasswordRequest $request): JsonResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) return response()->json(['message' => trans($status)], 200);
        else return response()->json(['errors' => ['email' => [$status]]], 401);
    }

    public function confirmationRegister(int $id, string $hash): RedirectResponse
    {
        if (RateLimiter::tooManyAttempts('confirmation-register:'.$id, $perMinute = 5)) abort(429);

        if (!$user = User::where('id',$id)->first()) $message = trans('auth.user_not_found');
        elseif ($user->active) $message = trans('auth.user_already_active');
        else if (!hash_equals(sha1($user->getEmailForVerification()), (string)$hash)) $message = trans('auth.wrong_token');
        else {
            $user->active = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            $message = trans('auth.register_success');
            auth()->login($user);
            event(new Verified($user));
        }
        return redirect(route('home'))->with('message',$message);
    }

    public function verificationNotification(ResetPasswordRequest $request): JsonResponse
    {
        $user = User::where('email',$request->email)->first();
        $user->sendEmailVerificationNotification();
        return response()->json(['message' => trans('auth.confirmation_mail_sent')], 200);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }

    protected function auth(LoginRequest $request, bool $checkAdmin): JsonResponse|RedirectResponse
    {
        $credentials = $request->validated();
        $credentials['active'] = 1;
        if ($checkAdmin) $credentials['is_admin'] = 1;
        if (Auth::attempt($credentials, $request->remember == 'on')) {
            $request->session()->regenerate();
            if ($checkAdmin) return redirect()->intended(route('admin.home'));
            else return response()->json(['success' => true, 'phone' => Auth::user()->phone, 'address' => Auth::user()->address],200);
        } else {
            if ($checkAdmin) return back()->withErrors(['email' => trans('auth.failed')]);
            else return response()->json(['errors' => ['email' => [trans('auth.failed')], 'password' => [trans('auth.failed')]]], 401);
        }
    }
}
