<?php

namespace App\Console\Commands\equipment;

use Illuminate\Support\Facades\Storage;
use App\Models\Equipment;
use App\Models\EquipmentReport;
use Illuminate\Console\Command;

class MonthlyEquipmentReport extends Command
{
    protected $signature = 'generate:equipment-monthly-report';
    protected $description = 'Generate the monthly equipment report';

    public function handle(): void
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
        $equipmentReport = Equipment::whereBetween('created_at', [$startDate, $endDate])->get();
        $timeStamp = now()->timestamp;

        $htmlContent = '
        <div style="width: 100%; font-family: Arial, Helvetica, sans-serif">
            <div style="margin: auto; display: flex; justify-content:center; align-items:center">
                <div>
                    <img src="public/icons/header_logo.png" alt="" srcset=""
                        style="width: 8rem; height: 8rem;">
                </div>
                <div style="width: 600px">
                    <span style="font-size: 1.15rem">REPUBLIC OF THE PHILIPPINES</span>
                    <br>
                    <span style="font-weight: 700; font-size: 1.15rem">Northern Mindanao Consortium for Agriculture,
                        Aquatic and Natural
                        Resources Research And Development (NOMCAARRD)</span>
                    <p style="font-size: 0.9rem; padding: 0px; margin: 0px;">Central Mindanao University, University Town,
                        Musuan, Bukidnon</p>
                    <p style="font-size: 0.9rem; padding: 0px; margin: 0px">Email address: nomcarrdcmu@gmail.com</p>
                    <p style="font-size: 0.9rem; padding: 0px; margin: 0px">Phone: 0917-102-7065</p>
                </div>
            </div>
            <hr style="width: 80%;">
            <div style="margin: auto; justify-content:center">
                <p style="text-align: center; font-weight: 700; font-size: 1.15rem">MONTHLY REPORT AS OF ' . now()->format('F j, Y') . '</p>
                <div style="margin: auto; width: 80%">
                    <span>
                        <i> *Note: Equipments listed below are based on this month\'s entry. If the equipment you wish to see is
                            not here, see other reports on equipment report. </i>
                    </span>
                </div>
                <div style="margin: auto; width: 80%">
                    <table style="border: 1px solid black; border-collapse:collapse; width: 100%">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black">Serial Number</th>
                                <th style="border: 1px solid black">Name</th>
                                <th style="border: 1px solid black">Amount</th>
                                <th style="border: 1px solid black">Date Acquired</th>
                                <th style="border: 1px solid black">Condition</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($equipmentReport as $equipment) {
            $htmlContent .= '
                            <tr>
                                <td style="border: 1px solid black">' . $equipment->serial_number . '</td>
                                <td style="border: 1px solid black">' . $equipment->name . '</td>
                                <td style="border: 1px solid black">' . $equipment->amount . '</td>
                                <td style="border: 1px solid black">' . $equipment->date_acquired . '</td>
                                <td style="border: 1px solid black">' . $equipment->condition . '</td>
                            </tr>';
        }

        $htmlContent .= '
                        </tbody>
                    </table>
                </div>
                <br>
                <div style="margin: auto; justify-content: center; width: 80%; display: flex;">
                    <div style="width: 100%; margin: 10px">
                        <span style="text-align: center">Prepared By: </span>
                        <br>
                        <div style="left: 0px;">
                            <div style="text-align: center">
                                <span style="font-weight: 700">Charlie Boquila</span>
                                <br>
                                <span> Inventory Officer</span>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; margin: 10px">
                        <span style="text-align: center">Approved By: </span>
                        <br>
                        <div style="right: 0px;">
                            <div style="text-align: center">
                                <span style="font-weight: 700">MARIA ESTELA B. DETALLA</span>
                                <br>
                                <span> Consortium Director</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        $filename = 'monthly_equipment_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';
        $storagePath = 'reports/equipmentreport/' . $filename;
        Storage::put($storagePath, $htmlContent);

        // Save the report metadata to the database
        EquipmentReport::create([
            'file_name' => $filename,
            'file_path' => $storagePath,
        ]);

        $this->info('Monthly equipment report generated successfully.');
    }
}
