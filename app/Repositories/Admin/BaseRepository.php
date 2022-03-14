<?php

namespace App\Repositories\Admin;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllWithPaginate(int $paginateNumber)
    {
        return $this->model->paginate($paginateNumber)->withQueryString();
    }

    public function getAllWithRelationPaginate(int $perPage, array $relations)
    {
        return $this->model->with($relations)->paginate($perPage)->withQueryString();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $result = $this->model->findOrFail($id);

        $result->update($attributes);

        return $result;
    }

    public function delete(int $id)
    {
        $result = $this->model->findOrFail($id);

        return $result->delete();
    }
}
