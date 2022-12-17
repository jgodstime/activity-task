<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login')->with('error', 'Kindly login to proceed');
        }

        if ($user->role !== UserRoleEnum::GetEnumsKeyByName('SUPER ADMIN')) {
            return redirect()->route('login')->with('error', 'Kindly login as super admin to proceed');
        }

        return $next($request);
    }
}
