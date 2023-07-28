<?php

namespace App\Repositories;

use App\Models\Mother;
use App\Repositories\interfaces\IMotherRepository;
use Illuminate\Support\Facades\DB;

class MotherRepository implements IMotherRepository
{

    public function save(array $mother)
    {
        return Mother::create(["name" => $mother["name"], "birth_day" => $mother["birth_day"]]);
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
        return DB::table("mothers")
            ->where("id", "=", $id)->get()->first();
    }

    public function findByName(string $name)
    {
        return DB::table("mothers")
            ->whereRaw("LOWER(name) LIKE ?", ["%" . strtolower($name) . "%"]);
    }

}
