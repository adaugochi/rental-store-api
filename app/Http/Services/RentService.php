<?php

namespace App\Http\Services;

use App\Http\Repositories\RentRepository;

class RentService
{
    protected $rentRepository;

    public function __construct()
    {
        $this->rentRepository = new RentRepository();
    }

    public function loadAll()
    {
        return $this->rentRepository->findAll([], ['user']);
    }

    public function addRent($postData)
    {
        return $this->rentRepository->insert($postData);
    }

    public function loadRentById($id)
    {
        $result =  $this->rentRepository->findFirst(['id' => $id], ['user']);
        if (!$result) throw new \ErrorException('Bad Request');
        return $result;
    }

    public function updateRent($postData, $id): bool
    {
        $result = $this->rentRepository->update($postData, $id);
        if (!$result) throw new \ErrorException('Bad Request');
        return true;
    }

    public function deleteRentById($id): bool
    {
        $result = $this->rentRepository->deleteById($id);
        if (!$result) throw new \ErrorException('Bad Request');
        return true;
    }
}
