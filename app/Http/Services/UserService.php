<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use ErrorException;

class UserService
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function loadAll()
    {
        return $this->userRepository->findAll([], [], 20);
    }

    /**
     * @throws ErrorException
     */
    public function getRentsByUserId($id)
    {
        $result =  $this->userRepository->findById($id);
        if (!$result) throw new ErrorException('Bad Request');
        return $result->rents;
    }
}
