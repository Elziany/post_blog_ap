<?php
namespace App\Services;
class ResponseService {
    public function success($data, $message = 'Success', $statusCode = 200) {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function error($message, $statusCode = 400) {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }
}