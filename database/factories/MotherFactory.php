<?php

namespace Database\Factories;

use App\Models\Mother;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
class MotherFactory extends Factory
{

    protected $model = Mother::class;

    public function definition()
    {
        $currentYear = Carbon::now()->year;
        $minBirthYear = $currentYear - 16;
        $maxBirthYear = $currentYear - 14;

        $birthDate = $this->faker->dateTimeBetween($minBirthYear . '-01-01', $maxBirthYear . '-12-31');
        $birthDay = Carbon::instance($birthDate)->format('Y-m-d');

        return [
            "name" => $this->faker->name,
            "birth_day" => $birthDay
        ];
    }
}
