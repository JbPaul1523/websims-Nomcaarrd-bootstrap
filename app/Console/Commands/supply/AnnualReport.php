<?php

namespace App\Console\Commands\supply;

use Illuminate\Support\Facades\Storage;
use App\Models\Assets;
use App\Models\SupplyReport;
use Illuminate\Console\Command;

class AnnualReport extends Command
{
    protected $signature = 'generate:supply-annual-report';
    protected $description = 'Generate the annual supply report';

    public function handle(): void
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();
        $suppliesReport = Assets::whereBetween('created_at', [$startDate, $endDate])->get();
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
                <p style="text-align: center; font-weight: 700; font-size: 1.15rem">ANNUAL REPORT AS OF ' . now()->format('F j, Y') . '</p>
                <div style="margin: auto; width: 80%">
                    <span>
                        <i> *Note: Supplies listed below are based on this year\'s entry. If the supply you wish to see is
                            not here, see other reports on supply report. </i>
                    </span>
                </div>
                <div style="margin: auto; width: 80%">
                    <table style="border: 1px solid black; border-collapse:collapse; width: 100%">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black">ID</th>
                                <th style="border: 1px solid black">Name</th>
                                <th style="border: 1px solid black">Description</th>
                                <th style="border: 1px solid black">Amount</th>
                                <th style="border: 1px solid black">Stock</th>
                                <th style="border: 1px solid black">Date Acquired</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($suppliesReport as $supply) {
            $htmlContent .= '
                            <tr>
                                <td style="border: 1px solid black">' . $supply->id . '</td>
                                <td style="border: 1px solid black">' . $supply->name . '</td>
                                <td style="border: 1px solid black">' . $supply->description . '</td>
                                <td style="border: 1px solid black">' . $supply->amount . '</td>
                                <td style="border: 1px solid black">' . $supply->stock . '</td>
                                <td style="border: 1px solid black">' . $supply->date_acquired . '</td>
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

        $filename = 'annual_supply_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';
        $storagePath = 'reports/supplyreport/' . $filename;
        Storage::put($storagePath, $htmlContent);

        // Save the report metadata to the database
        SupplyReport::create([
            'file_name' => $filename,
            'file_path' => $storagePath,
        ]);

        $this->info('Annual supply report generated successfully.');
    }
}
