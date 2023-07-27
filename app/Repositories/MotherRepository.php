<?php

namespace App\Repositories;

use App\Models\Mother;

class MotherRepository implements IMotherRepository
{

    public function save(array $mother)
    {
        return Mother::create($mother);
    }
    public function delete(string $id)
    {
        return Mother::destroy($id);
    }
    public function findAll($page)
    {
        return Mother::paginate($page);
    }
    public function findById(string $id)
    {
        return Mother::where("id", $id);
    }
    public function findByName(string $name)
    {
        return Mother::where("name", $name);
    }
}
