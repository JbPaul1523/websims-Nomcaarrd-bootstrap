<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assets; // Assuming Asset model exists
use Illuminate\Support\Str;

class AssetSeeder extends Seeder
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

        for ($i = 0; $i < $numberOfRecords; $i++) {
            Assets::create([
                'name' => 'Asset ' . ($i + 1),
                'description' => 'Random description for Asset ' . ($i + 1),
                'amount' => rand(100, 10000) / 100, // Random amount between 1 and 10000
                'stock' => rand(0, 100), // Random stock between 0 and 100
                'date_acquired' => now()->subDays(rand(1, 365)), // Random date within the last year
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
