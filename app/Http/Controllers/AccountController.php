<?php

namespace App\Http\Controllers;
use App\Http\Requests\Account\EditAccountRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use HelperTrait;

    public function account(): JsonResponse
    {
        return response()->json([
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'address' => Auth::user()->address,
        ],200);
    }

    public function editAccount(EditAccountRequest $request): JsonResponse
    {
        $fields = $request->validated();
        if ($request->password && $request->old_password) {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return response()->json(['errors' => ['old_password' => [trans('auth.old_password_error')]]], 401);
            } else {
                $fields['password'] = Hash::make($request->password);
            }
        }
        unset($fields['i_agree']);
        User::where('id',Auth::id())->update($fields);
        return response()->json(['message' => trans('content.save_complete')],200);
    }
}
