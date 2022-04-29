<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(): JsonResponse
    {
        $data = $this->userService->loadAll();
        return $this->apiResponse(['success' => true, 'result' => $data]);
    }

    public function getUserRents($id = null): JsonResponse
    {
        try {
            $data = $this->userService->getRentsByUserId($id);
            return $this->apiResponse(['success' => true, 'result' => $data]);
        } catch (\ErrorException $ex) {
            return $this->respondError($ex->getMessage());
        }
    }
}
