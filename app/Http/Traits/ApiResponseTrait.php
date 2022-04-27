<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Return generic json response with the given data.
     *
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function apiResponse(array $data = [], int $statusCode = 200, array $headers = []): JsonResponse
    {
        $result = $this->parseGivenData($data, $statusCode, $headers);

        return response()->json(
            $result['content'],
            $result['statusCode'],
            $result['headers'],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return array
     */
    public function parseGivenData(array $data = [], int $statusCode = 200, array $headers = []): array
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'result'  => $data['result'] ?? null,
        ];

        if (isset($data['error'])) {
            $responseStructure['error'] = $data['error'];
        }

        if (isset($data['status'])) {
            $statusCode = $data['status'];
        }

        if ($data['success'] === false) {
            if (isset($data['error_code'])) {
                $responseStructure['error_code'] = $data['error_code'];
            } else {
                $responseStructure['error_code'] = 1;
            }
        }

        return ['content' => $responseStructure, 'statusCode' => $statusCode, 'headers' => $headers];
    }

    /**
     * Respond with success.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function respondSuccess(string $message = '', int $statusCode = 200): JsonResponse
    {
        return $this->apiResponse(['success' => true, 'message' => $message], $statusCode);
    }

    /**
     * Respond with error.
     *
     * @param $message
     * @param int $statusCode
     * @param int $error_code
     * @return JsonResponse
     */
    protected function respondError($message, int $statusCode = 400, int $error_code = 1): JsonResponse
    {
        return $this->apiResponse([
            'success'    => false,
            'message'    => $message ?? 'There was an internal error, Pls try again later',
            'error_code' => $error_code,
        ], $statusCode);
    }
}
