<?php

namespace App\Repositories\interfaces;
interface IInfantsRepository extends CrudRepository
{
    public function findByRangeOfBirthDay(string $startbirthDay, string $endBirthday, int $page);
    public function getYearlyAnalytics(string $year);
}
