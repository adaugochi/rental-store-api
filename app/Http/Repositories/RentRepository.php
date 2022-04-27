<?php

namespace App\Http\Repositories;

use App\Models\Rent;

class RentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Rent();
        parent::__construct($this->model);
    }
}
