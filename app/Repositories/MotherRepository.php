<?php

namespace App\Repositories;

use App\Models\Mothers;
use App\Repositories\interfaces\IMotherRepository;
use Illuminate\Support\Facades\DB;

class MotherRepository implements IMotherRepository
{

    public function save(array $mother)
    {
        return Mothers::create($mother);
    }

    public function delete(string $id)
    {
        return Mothers::destroy($id);
    }

    public function findAll($page)
    {
        return Mothers::paginate(10, ["*"], "page", $page);
    }

    public function findById(string $id)
    {
        return Mothers::find($id)->get()->first();
    }

    public function findByName(string $name)
    {
        return DB::table("mothers")
            ->whereRaw("LOWER(name) LIKE ?", ["%" . strtolower($name) . "%"]);
    }

    public function update(string $id, array $data)
    {
        $mothers = $this->findById($id);
        $mothers->update($data);
        return $mothers;
    }

}
