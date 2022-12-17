<?php

namespace App\Services\Admin;

use App\Enums\UserRoleEnum;
use App\Models\Activity;
use App\Models\User;

class ActivityService
{
    public function __construct(private Activity $activity,
                                private User $user)
    {
    }

    /**
     * Create activity for all users
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createGlobalActivity(array $data): \Illuminate\Http\RedirectResponse
    {
        $dateActivityCount = $this->activity->whereDate('date', $data['date'])->getGlobal()->get()->unique('activity_no')->count();

        if ($dateActivityCount >= 3) {
            return back()->with('error', "You already have a maximum of $dateActivityCount activities created for the selected date");
        }

        $data['image'] = $data['image']->store('activity_images', 'public');

        // get all the users
        $usersIds = $this->user->where('role', UserRoleEnum::GetEnumsKeyByName('USER'))->pluck('id');

        // check if at least 1 user is found
        if (! count($usersIds) > 0) {
            return back()->with('error', 'User not fount to assign activity, kindly create at least one user');
        }

        $data['activity_no'] = $this->activity::generateUniqueActivityNo();

        $tasks = collect($usersIds)->map(function ($userid) use ($data) {
            $data['user_id'] = $userid;
            $data['created_at'] = now()->toDateTimeString();
            $data['updated_at'] = now()->toDateTimeString();

            return $data;
        })->toArray();

        $this->activity->insert($tasks);

        return back()->with('success', 'Activity created');
    }

    /**
     * Create activity for a user
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUserActivity(array $data): \Illuminate\Http\RedirectResponse
    {
        if (! $this->user->where('id', $data['user_id'])->first()) {
            return back()->with('error', 'User not found');
        }

        $data['image'] = $data['image']->store('activity_images', 'public');

        $activity = $this->activity->create($data);

        if (! $activity) {
            return back()->with('error', 'Unable to create activity at this time, try again');
        }

        return back()->with('success', 'Activity created');
    }

    /**
     * Update activity for all user
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGlobalActivity(array $data): \Illuminate\Http\RedirectResponse
    {
        $activity = $this->activity->where('activity_no', $data['activity_no'])->first();

        if (isset($data['image']) && ! empty($data['image'])) {
            $data['image'] = $data['image']->store('activity_images', 'public');
            @unlink($activity->image); // delete previous image
        }

        $this->activity->where('activity_no', $data['activity_no'])->update($data);

        return back()->with('success', 'Activity updated ');
    }

    /**
     * Update activity for a user
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserActivity(array $data): \Illuminate\Http\RedirectResponse
    {
        $activity = $this->activity->where('id', $data['activity_id'])->first();

        if (! $activity) {
            return back()->with('error', 'Activity not found');
        }

        // if this is not changed, global update will still affect this guy
        // $data['activity_no'] = $this->activity::generateUniqueActivityNo(); // change the activity no becasuse it was upated for a user, its no longer tied to global activity

        if (isset($data['image']) && ! empty($data['image'])) {
            $data['image'] = $data['image']->store('activity_images', 'public');
        }

        $activity->update($data);

        return back()->with('success', 'Activity updated');
    }

    /**
     * Delete activity for all user that the global activity was created for using the $activityNumber
     *
     * @param  string  $activityNumber
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGlobalActivity(string $activityNumber): \Illuminate\Http\RedirectResponse
    {
        $activity = $this->activity->where('activity_no', $activityNumber)->first();

        if (! $activity) {
            return back()->with('error', 'Activity not found');
        }

        $this->activity->where('activity_no', $activityNumber)->delete();

        @unlink($activity->image);

        return back()->with('success', 'Activity deleted');
    }

    /**
     * Delete single activity
     *
     * @param  string  $activityId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteActivity(string $activityId): \Illuminate\Http\RedirectResponse
    {
        $activity = $this->activity->where('id', $activityId)->first();

        if (! $activity) {
            return back()->with('error', 'Activity not found');
        }

        @unlink($activity->image);
        $activity->delete();

        return back()->with('success', 'Activity deleted');
    }
}
