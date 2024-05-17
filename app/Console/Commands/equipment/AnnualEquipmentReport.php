<?php

namespace App\Console\Commands\equipment;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Equipment;
use App\Models\EquipmentReport; // Include the SupplyReport model
use Illuminate\Console\Command;

class AnnualEquipmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:equipment-annual-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle():void
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();
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

        $filename = 'annual_equipment_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';
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
