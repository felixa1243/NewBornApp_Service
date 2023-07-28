<?php
namespace App\Services;

use Illuminate\Http\Request;

interface IMotherService{
    public function findAll(int $pageNumber);
    public function create(Request $request);
}
