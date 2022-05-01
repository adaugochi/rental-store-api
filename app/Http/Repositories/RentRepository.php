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

    public function intervalLogs($type, $status, $interval = 1)
    {
        return $this->model
            ->where(['rent_type' => $type, 'status' => $status])
            ->whereRaw("created_at > CURRENT_DATE() - INTERVAL $interval MONTH")
            ->get();
    }
}
