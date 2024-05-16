<?php
// app/Console/Commands/WeeklyReport.php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Assets;
use App\Models\SupplyReport; // Include the SupplyReport model
use Illuminate\Console\Command;

class WeeklyReport extends Command
{
    protected $signature = 'generate:weekly-report';
    protected $description = 'Command description';

    public function handle(): void
    {
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();
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

        $filename = 'weekly_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';
        $storagePath = 'reports/' . $filename;
        Storage::put($storagePath, $htmlContent);

        // Save the report metadata to the database
        SupplyReport::create([
            'file_name' => $filename,
            'file_path' => $storagePath,
        ]);

        $this->info('Weekly report generated successfully.');
    }
}
