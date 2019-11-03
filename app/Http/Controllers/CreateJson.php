<?php

namespace App\Http\Controllers;

class CreateJson
{
    /**
     * @param array $status
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function normal(array $status = [], array $data)
    {
        $response = [
            'meta' => [
                'status' => [
                    'code' => "$status[0]", 'message' => "$status[1] Complete",]
            ],
            'data' => $data,
        ];
        return \response()->json($response);
    }

    /**
     * @param array $status
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validateError(array $status = [], array $data)
    {
        $response = [
            'meta' => [
                'status' => [
                    'code' => "$status[0]", 'message' => "$status[1] Validate Error",]
            ],
            'data' => $data,
        ];
        return \response()->json($response);
    }

    /**
     * @param array $status
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error(array $status = [], array $data)
    {
        $response = [
            'meta' => [
                'status' => [
                    'code' => "$status[0]", 'message' => "$status[1] Error",]
            ],
            'data' => $data,
        ];
        return \response()->json($response);
    }
}