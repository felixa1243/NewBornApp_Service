<?php

namespace App\Repositories\interfaces;
interface IinfantsRepository extends CrudRepository
{
    public function findByRangeOfBirthDay(string $startbirthDay,string $endBirthday);
}
