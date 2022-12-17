<?php

namespace App\Services\Api;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Carbon\Carbon;

class ActivityService extends BaseService
{
    public function __construct(private Activity $activity)
    {
    }

    /**
     * Get User Activities
     *
     * @param  array  $data
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserActivities(array $data): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $activities = $this->activity->where('user_id', auth()->id());

        if (isset($data['from_date']) && ! empty($data['from_date']) && isset($data['to_date']) && ! empty($data['to_date'])) {
            $activities->whereBetween('date', [Carbon::parse($data['from_date']), Carbon::parse($data['to_date'])]);
        }

        return ActivityResource::collection($activities->paginate());
    }
}
