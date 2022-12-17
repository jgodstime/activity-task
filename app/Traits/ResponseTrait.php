<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param  mixed  $data
     * @param  string  $message
     * @return JsonResponse
     */
    public function successResponse(mixed $data = [], string $message = ''): JsonResponse
    {
        return response()->json(['data' => $data, 'message' => $message]);
    }

    /**
     * @param  string  $message
     * @param  int  $error_code
     * @return JsonResponse
     */
    public function errorResponse(string $message = '', int $error_code = 401): JsonResponse
    {
        return response()->json(['message' => $message], $error_code);
    }
}
