<?php

namespace App\Services\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthService extends BaseService
{
    public function __construct(private User $user)
    {
    }

    /**
     * Login User
     *
     * @param  array  $data
     * @return JsonResponse|UserResource
     */
    public function login(array $data): JsonResponse|UserResource
    {
        if (! auth()->attempt($data)) {
            return $this->errorResponse('Invalid login credential', 401);
        }

        $user = auth()->user();

        $user->token = $user->createToken('user')->plainTextToken;

        return new UserResource($user);
    }

    /**
     * Register User
     *
     * @param  array  $data
     * @return JsonResponse|UserResource
     */
    public function register(array $data): JsonResponse|UserResource
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->user->create($data);

        if (! $user) {
            return $this->errorResponse('Unable to create account, please try again', 500);
        }

        $user->token = $user->createToken('user')->plainTextToken;

        return new UserResource($user);
    }
}
