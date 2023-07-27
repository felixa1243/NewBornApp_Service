<?php

namespace Database\Factories;

use App\Models\Mother;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotherFactory extends Factory
{

    protected $model = Mother::class;

    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "birth_day" => $this->faker->date
        ];
    }
}
