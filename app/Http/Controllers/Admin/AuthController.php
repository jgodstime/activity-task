<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Admin\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authservice)
    {
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAction(LoginRequest $request)
    {
        return $this->authservice->login($request->validated());
    }
}
