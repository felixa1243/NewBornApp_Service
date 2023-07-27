<?php
namespace App\Repositories;

interface IMotherRepository{
    public function save(array $motherData);
    public function delete(string $id);
    public function findAll($page);
    public function findById(string $id);
    public function findByName(string $name);
}