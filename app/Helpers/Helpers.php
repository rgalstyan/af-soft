<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

final class Helpers
{
    public static function generateResponse(string $message, $status): JsonResponse
    {
        return response()->json(['message' => $message], $status);
    }
}
