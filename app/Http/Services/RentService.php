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
}
