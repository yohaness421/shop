<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Формирование стандартизированного ответа.
     *
     * @param string $status
     * @param mixed $data
     * @param string|null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendResponse(string $success, $data = null, string $message = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Формирование ответа об ошибке.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendError(string $message, int $statusCode = 400): JsonResponse
    {
        return $this->sendResponse('false', null, $message, $statusCode);
    }

    /**
     * Формирование успешного ответа.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendSuccess($data, string $message = null, int $statusCode = 200): JsonResponse
    {
        return $this->sendResponse('true', $data, $message, $statusCode);
    }
}
