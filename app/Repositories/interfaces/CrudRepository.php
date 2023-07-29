<?php
namespace App\Repositories\interfaces;

interface CrudRepository{
    public function save(array $data);
    public function delete(string $id);
    public function findAll($page);
    public function findById(string $id);
    public function findByName(string $name);
}
