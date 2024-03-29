<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use HelperTrait;

    public function login(LoginRequest $request): JsonResponse|RedirectResponse
    {
        return $this->auth($request, false);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $token = Str::random(30);
        $credentials['password'] = bcrypt($credentials['password']);
        $credentials['confirmation_token'] = $token;
        User::create($credentials);
        $this->sendMessage('registration', $request->email, ['token' => $token]);
        return response()->json(['message' => trans('auth.check_your_mail')],200);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        if ($user = User::where('email',$request->email)->where('active',1)->first()) $message = trans('auth.user_not_found');
        else {
            $newPassword = Str::random(5);
            $user->password = bcrypt($newPassword);
            $message = trans('auth.new_password');
            $this->sendMessage('registration', $request->email, ['newPassword' => $newPassword]);
        }
        return response()->json(['message' => $message],200);
    }

    public function confirmationRegister($slug): RedirectResponse
    {
        if (!$user = User::where('confirmation_token',$slug)->first()) session()->flash('message', trans('auth.user_not_found'));
        elseif ($user->active) session()->flash('message', trans('auth.user_already_active'));
        else {
            $user->active = 1;
            $user->save();
            session()->flash('message', trans('auth.register_success'));
        }
        return redirect(route('home'));
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
