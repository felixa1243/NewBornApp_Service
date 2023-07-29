<?php

namespace Database\Factories;

use App\Models\Infants;
use App\Models\Mothers;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfantsFactory extends Factory
{
    protected $model = Infants::class;

    public function definition()
    {
        $birthday = $this->faker->dateTimeBetween("-300 weeks")->format("Y-m-d");
        $birthdayDateTime = new DateTime($birthday);

        $earliestGestationalBegin = clone $birthdayDateTime;
        $earliestGestationalBegin->modify('-42 weeks');

        $latestGestationalBegin = clone $birthdayDateTime;
        $latestGestationalBegin->modify('-35 weeks');

        $gestationalBegin = $this->
        faker->dateTimeBetween($earliestGestationalBegin, $latestGestationalBegin)
            ->format("Y-m-d");
        return [
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_day' => $birthdayDateTime->format("Y-m-d"),
            'height' => $this->faker->numberBetween(30, 55),
            'weight' => $this->faker->numberBetween(2, 5),
            'gestational_begin' => $gestationalBegin,
            'mother_id' => Mothers::factory()->create()->id,
            'description' => $this->faker->sentence
        ];
    }


}
