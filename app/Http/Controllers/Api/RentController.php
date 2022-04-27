<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ModelNotSavedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RentRequest;
use App\Http\Services\RentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentController extends Controller
{
    protected $rentService;

    public function __construct()
    {
        $this->rentService = new RentService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->rentService->loadAll();
        return $this->apiResponse(['success' => true, 'result' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RentRequest $request
     * @return JsonResponse
     */
    public function store(RentRequest $request): JsonResponse
    {
        try {
            $this->rentService->addRent($request->all());
            return $this->respondSuccess('Rent saved successfully', 201);
        } catch (ModelNotSavedException $ex) {
            return $this->respondError($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id):JsonResponse
    {
        try {
            $data = $this->rentService->loadRentById($id);
            return $this->apiResponse(['success' => true, 'result' => $data]);
        } catch (\ErrorException $ex) {
            return $this->respondError($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id):JsonResponse
    {
        try {
            $this->rentService->updateRent($request->all(), $id);
            return $this->respondSuccess('Rent updated successfully');
        } catch (ModelNotSavedException | \ErrorException $ex) {
            return $this->respondError($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->rentService->deleteRentById($id);
            return $this->respondSuccess('Rent deleted successfully');
        } catch (\ErrorException $ex) {
            return $this->respondError($ex->getMessage());
        }
    }
}
