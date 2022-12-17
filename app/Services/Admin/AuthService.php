<?php

namespace App\Services\Admin;

use App\Models\User;

class AuthService
{
    public function __construct(private User $user)
    {
    }

    /**
     * Login Admin
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(array $data): \Illuminate\Http\RedirectResponse
    {
        if (! auth()->attempt($data)) {
            return back()->with('error', 'Invalid login credentials');
        }

        return redirect()->route('admin.activities.dashboard')->with('success', 'You are logged in');
    }
}
