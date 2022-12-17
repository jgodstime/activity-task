<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Requests\UpdateGlobalActivityRequest;
use App\Models\Activity;
use App\Models\User;
use App\Services\Admin\ActivityService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct(private ActivityService $activityService)
    {
    }

    public function dashboard()
    {
        $users = User::where('role', UserRoleEnum::GetEnumsKeyByName('USER'))->limit(10)->get();

        return view('admin.activity.dashboard', [
            'users' => $users,
            'activityForTodayCount' => Activity::whereDate('date', Carbon::today())->distinct()->count('activity_no'),
            'activityCreatedTodayCount' => Activity::whereDate('created_at', Carbon::today())->distinct()->count('activity_no'),
            'totalActivity' => Activity::get()->unique('activity_no')->count(),
        ]);
    }

    public function index(Request $request)
    {
        if (isset($request['title']) && ! empty($request['title'])) {
            $activities = Activity::getGlobal()->orderBy('date', 'DESC')->get()->unique('activity_no');
        } else {
            $activities = Activity::getGlobal()->orderBy('date', 'DESC')->where('title', 'LIKE', "%{$request['title']}%")->get()->unique('activity_no');
        }

        return view('admin.activity.index', [
            'activities' => $activities,
            'count' => $activities->count(),
        ]);
    }

    public function userActivities($userId)
    {
        $user = User::with('activities')->where('id', $userId)->first();

        if (! $user) {
            return back()->with('error', 'User not found');
        }

        return view('admin.activity.user', [
            'user' => $user,
        ]);
    }

    // for single user activity
    public function storeUserActivity($userId, CreateActivityRequest $request)
    {
        return $this->activityService->createUserActivity($request->validated() + ['user_id' => $userId]);
    }

    public function storeGlobal(CreateActivityRequest $request)
    {
        return $this->activityService->createGlobalActivity($request->validated());
    }

    public function updateGlobal(UpdateGlobalActivityRequest $request)
    {
        return $this->activityService->updateGlobalActivity($request->validated());
    }

    public function updateSingle(UpdateActivityRequest $request)
    {
        return $this->activityService->updateUserActivity($request->validated());
    }

    public function destroyGlobal($activityNo)
    {
        return $this->activityService->deleteGlobalActivity($activityNo);
    }

    public function destroySingle($activityId)
    {
        return $this->activityService->deleteActivity($activityId);
    }
}
