<?php

namespace App\Http\Services;

use App\Http\Repositories\RentRepository;
use App\Models\Rent;
use ErrorException;

class RentService
{
    protected $rentRepository;

    public function __construct()
    {
        $this->rentRepository = new RentRepository();
    }

    public function loadAll($type, $status)
    {
        if ($type && $status) {
            return $this->rentRepository->findAll(['rent_type' => $type, 'status' => $status], ['user'], 20);
        } elseif ($status) {
            return $this->rentRepository->findAll(['status' => $status], ['user'], 20);
        } elseif ($type) {
            return $this->rentRepository->findAll(['rent_type' => $type], ['user'], 20);
        } else {
            return $this->rentRepository->findAll([], ['user'], 20);
        }
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
        $result = $this->rentRepository->intervalLogs($type, $status);
        if ($result) return count($result);

        return 0;
    }

    public function getLogs(): array
    {
        return [
            'Total books rented' => $this->getTotalCountByTypeAndStatus(Rent::BOOKS, Rent::RENTED),
            'Total books returned' => $this->getTotalCountByTypeAndStatus(Rent::BOOKS, Rent::RETURNED),
            'Total equipment rented' => $this->getTotalCountByTypeAndStatus(Rent::EQUIPMENT, Rent::RENTED),
            'Total equipment returned' => $this->getTotalCountByTypeAndStatus(Rent::EQUIPMENT, Rent::RETURNED)
        ];
    }
}
