<?php

namespace App\Traits;

trait ResponseHandler
{

    public function responseSuccess(string $message, int $code)
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ], $code);
    }

    public function responseFailure(string $message, string $errorType, int $code)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error type' => $errorType
        ], $code);
    }

    public function responseData(array $data, int $code)
    {
        return response()->json($data, $code);
    }
}
