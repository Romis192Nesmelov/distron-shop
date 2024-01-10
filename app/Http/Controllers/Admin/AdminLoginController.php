<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;

class AdminLoginController extends AuthController
{
    public function login(LoginRequest $request): RedirectResponse
    {
        return $this->auth($request, true);
    }
}
