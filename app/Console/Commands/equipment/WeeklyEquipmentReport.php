<?php

// app/Console/Commands/equipment/WeeklyEquipmentReport.php

namespace App\Console\Commands\equipment;

use Illuminate\Support\Facades\Storage;
use App\Models\Equipment;
use App\Models\EquipmentReport;
use Illuminate\Console\Command;

class WeeklyEquipmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:equipment-weekly-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the weekly equipment report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();
        $equipmentReport = Equipment::all();
        $timeStamp = now()->timestamp;

        $htmlContent = '
        <div>
        <p style="font-size:1.25rem; font-weight: 700"> NOMCAARRD Equipment Report as of '. $timeStamp .'
        </div>
            <div style="width: 100%;">
                        <table border="1" style="border-collapse: collapse; width:100%">
                    <thead>
                        <tr align="left">
                            <th>Serial Number</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Date Acquired</th>
                            <th>Condition</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($equipmentReport as $equipment){
                           $htmlContent .= '<tr>
                                <td>' .  $equipment->serial_number  . '</td>
                                <td>' .  $equipment->name . '</td>
                                <td>' .  $equipment->amount . '</td>
                                <td>' .  $equipment->date_acquired . '</td>
                                <td>' .  $equipment->condition . '</td>
                            </tr>';
                        }
                $htmlContent .= '</tbody></table></div>
        ';

        $filename = 'weekly_equipment_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';
        $storagePath = 'reports/equipmentreport/' . $filename;
        Storage::put($storagePath, $htmlContent);

        // Save the report metadata to the database
        EquipmentReport::create([
            'file_name' => $filename,
            'file_path' => $storagePath,
        ]);

        $this->info('Weekly equipment report generated successfully.');
    }
}
