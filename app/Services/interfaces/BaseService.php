<?php

namespace App\Services\interfaces;

use Illuminate\Http\Request;

interface BaseService
{
    public function findAll(int $pageNumber);

    public function create(Request $request);

    public function findById(string $id);

    public function findByName(string $name);

    public function remove(string $id);

    public function update(string $id, Request $request);
}
