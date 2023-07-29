<?php

namespace Database\Seeders;

use App\Models\Infants;
use Illuminate\Database\Seeder;
use App\Models\Mothers;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mothers::factory(15)->create();
        Infants::factory(15)->create();
    }
}
