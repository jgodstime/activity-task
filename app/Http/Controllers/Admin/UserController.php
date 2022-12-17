<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\ActivityService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private ActivityService $activityService)
    {
    }

    public function index(Request $request)
    {
        $users = User::with('activities')->withCount('activities')->where('role', UserRoleEnum::GetEnumsKeyByName('USER'))->paginate();

        return view('admin.user.index', [
            'users' => $users,
        ]);
    }
}
