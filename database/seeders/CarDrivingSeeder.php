<?php

namespace Database\Seeders;

use App\Models\CarDriving;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarDrivingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarDriving::factory()
            ->count(5)
            ->create();
    }
}
