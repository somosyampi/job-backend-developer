<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class TypesReturn
{
    protected function response(string $type = null, string $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'type' => $type,
            'message' => $message,
        ], $status);
    }
}
