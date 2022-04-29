<?php

namespace App\Http\Repositories;

class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findFirst($conditions, $with = [])
    {
        return $this->model->where($conditions)->with($with)->first();
    }

    public function findAll($conditions = [], $with = [], $paginate = null)
    {
        $result = $this->model->where($conditions)->with($with)->orderBy('id', 'DESC');

        if ($paginate) {
            return $result->paginate($paginate);
        }
        return $result->get();
    }

    public function insert($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($attributes, $id): bool
    {
        $result = $this->findById($id);
        if ($result) {
            return $result->update($attributes);
        }
        return false;
    }

    public function deleteById($id): bool
    {
        $result = $this->findById($id);
        if ($result) {
            return $this->model->destroy($id);
        }
        return false;
    }

    public function deleteFirst($conditions): bool
    {
        $result = $this->findFirst($conditions);
        if ($result) {
            return $this->model->destroy($result->id);
        }
        return false;
    }
}
