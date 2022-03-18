<?php

namespace App\Repositories\Admin;

interface BaseRepositoryInterface
{
    // Get all records of model
    public function getAll();

    // Find an record of model
    public function find(int $id);

    // Find by where and order by
    public function findByWhere(array $where, $orderBy = 'id', $order = 'asc');

    // Create new record
    public function create(array $attributes);

    // Update an record
    public function update(int $id, array $attributes);

    // Delete an record
    public function delete(int $id);

    // Get all records of model with pagination
    public function getAllWithPaginate(int $paginateNumber);

    // Get all records of model with pagination and relationships
    public function getAllWithRelationPaginate(int $perPage, array $relations);

    // Get records by where in
    public function getRecordByWhereIn(string $condition, array $attributes);
}
