<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the number of records you want to create
        $numberOfRecords = 10;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            Equipment::create([
                'name' => 'Equipment ' . ($i + 1),
                'serial_number' => 'SN' . rand(1000, 9999), // Random serial number
                'condition' => rand(0, 1) ? 'good' : 'condemned', // Randomly select condition
                'amount' => rand(100, 10000), // Random amount
                'description' => 'Random description for Equipment ' . ($i + 1),
                'date_acquired' => now()->subDays(rand(1, 365))->toDateString(), // Random date within the last year
            ]);
        }
    }
}
