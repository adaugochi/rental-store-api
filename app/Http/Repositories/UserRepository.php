<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }
}
