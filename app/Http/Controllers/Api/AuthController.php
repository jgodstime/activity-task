<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\Api\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authservice)
    {
    }

    public function login(LoginRequest $request)
    {
        return $this->authservice->login($request->validated());
    }

    public function register(RegisterUserRequest $request)
    {
        return $this->authservice->register($request->validated());
    }
}
