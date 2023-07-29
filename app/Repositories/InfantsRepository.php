<?php

namespace App\Repositories;

use App\Models\Infants;
use App\Repositories\interfaces\IinfantsRepository;
use Illuminate\Support\Facades\DB;

class InfantsRepository implements IinfantsRepository
{
    public function save(array $data)
    {
        return Infants::create($data);
    }

    public function delete(string $id)
    {
        return Infants::destroy($id);
    }

    public function findAll($page)
    {
        return Infants::select('*', DB::raw('FLOOR(DATEDIFF(birth_day, gestational_begin) / 7) AS gestational_age_weeks'))
            ->paginate(10, ['*'], 'page', $page);
    }


    public function findById(string $id): array
    {
        return (array)DB::table("infants")->where("id", $id)->first();
    }

    public function findByName(string $name): array
    {
        return DB::table("infants")
            ->whereRaw("LOWER(name) LIKE ?", ["%" . strtolower($name) . "%"])
            ->get()->all();
    }

    public function findByRangeOfBirthDay(string $startBirthday, string $endBirthday)
    {
        return DB::table("infants")
            ->whereBetween("birth_day", [$startBirthday, $endBirthday])
            ->get();
    }

}
