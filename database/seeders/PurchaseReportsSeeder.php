<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseReport;

class PurchaseReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random PurchaseReports
        for ($i = 0; $i < 10; $i++) {
            PurchaseReport::create([
                'pr_no' => rand(1000, 9999), // Generate a random PR number
                'name' => 'Sample Purchase Report ' . ($i + 1),
                'description' => 'Description for Sample Purchase Report ' . ($i + 1),
                'category' => ['equipment', 'supplies'][rand(0,1)],
                // No need to specify related table IDs here
            ]);
        }

        // Add more sample data as needed
    }
}
