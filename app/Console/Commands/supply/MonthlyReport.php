<?php

namespace App\Console\Commands\supply;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Assets;
use App\Models\SupplyReport; // Include the SupplyReport model
use Illuminate\Console\Command; // Include the SupplyReport model

class MonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:supply-monthly-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
        $suppliesReport = Assets::all();
        $timeStamp = now()->timestamp;

        $htmlContent = '
        <div>
        <p style="font-size:1.25rem; font-weight: 700"> NOMCAARRD Supplies Report as of '. $timeStamp .'
        </div>
            <div style="width: 100%;">
                        <table border="1" style="border-collapse: collapse; width:100%">
                    <thead>
                        <tr align="left">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Stock</th>
                            <th>Date Acquired</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($suppliesReport as $supply){
                           $htmlContent .= '<tr>
                                <td>' .  $supply->id  . '</td>
                                <td>' .  $supply->name . '</td>
                                <td>' .  $supply->description . '</td>
                                <td>' .  $supply->amount . '</td>
                                <td>' .  $supply->stock . '</td>
                                <td>' .  $supply->date_acquired . '</td>
                            </tr>';
                        }
                $htmlContent .= '</tbody></table></div>
        ';

        $filename = 'monthly_supply_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';
        $storagePath = 'reports/supplyreport/' . $filename;
        Storage::put($storagePath, $htmlContent);

        // Save the report metadata to the database
        SupplyReport::create([
            'file_name' => $filename,
            'file_path' => $storagePath,
        ]);

        $this->info('Monthly report generated successfully.');
    }
}
