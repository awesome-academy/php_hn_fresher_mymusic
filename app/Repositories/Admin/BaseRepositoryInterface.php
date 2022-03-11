<?php

namespace App\Repositories\Admin;

interface BaseRepositoryInterface
{
    public function getAll();
    public function find(int $id);
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function delete(int $id);
}
