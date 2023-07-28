<?php
namespace App\Services;

use Illuminate\Http\Request;

interface IMotherService{
    public function findAll(int $pageNumber);
    public function create(Request $request);
    public function findById(string $id);
    public function findByName(string $name);
}
