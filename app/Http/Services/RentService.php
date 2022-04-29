<?php

namespace App\Http\Services;

use App\Http\Repositories\RentRepository;
use ErrorException;

class RentService
{
    protected $rentRepository;

    public function __construct()
    {
        $this->rentRepository = new RentRepository();
    }

    public function loadAll()
    {
        return $this->rentRepository->findAll([], ['user'], 10);
    }

    public function addRent($postData)
    {
        return $this->rentRepository->insert($postData);
    }

    /**
     * @throws ErrorException
     */
    public function loadRentById($id)
    {
        $result =  $this->rentRepository->findFirst(['id' => $id], ['user']);
        if (!$result) throw new ErrorException('Bad Request');
        return $result;
    }

    /**
     * @throws ErrorException
     */
    public function updateRent($postData, $id): bool
    {
        $result = $this->rentRepository->update($postData, $id);
        if (!$result) throw new ErrorException('Bad Request');
        return true;
    }

    /**
     * @throws ErrorException
     */
    public function deleteRentById($id): bool
    {
        $result = $this->rentRepository->deleteById($id);
        if (!$result) throw new ErrorException('Bad Request');
        return true;
    }

    public function getTotalCountByTypeAndStatus($type, $status): int
    {
        $result = $this->rentRepository->findAll(['rent_type' => $type, 'status' => $status]);
        if ($result) return count($result);

        return 0;
    }
}
