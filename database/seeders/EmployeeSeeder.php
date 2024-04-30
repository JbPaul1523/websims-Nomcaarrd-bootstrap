<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee; // Assuming Employee model exists
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of records you want to create
        $numberOfRecords = 10;

        $faker = Faker::create();

        for ($i = 0; $i < $numberOfRecords; $i++) {
            Employee::create([
                'name' => $faker->name,
                'position' => $faker->jobTitle,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
