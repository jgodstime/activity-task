<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRangeRequest;
use App\Services\Api\ActivityService;

class ActivityController extends Controller
{
    public function __construct(private ActivityService $activityService)
    {
    }

    public function getUserActivities(DateRangeRequest $request)
    {
        return $this->activityService->getUserActivities($request->validated());
    }
}
