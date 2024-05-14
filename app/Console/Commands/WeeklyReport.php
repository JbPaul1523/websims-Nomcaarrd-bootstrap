<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Assets;

use Illuminate\Console\Command;

class WeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:weekly-report';

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
    public function handle(): void
    {
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();

        // $suppliesReport = DB::table('assets')
        //     ->select('name as item', DB::raw('SUM(stock) as total_quantity'))
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->groupBy('name')
        //     ->get()
        //     ->toArray();

        $suppliesReport = Assets::all();
        $timeStamp = now()->timestamp;


        $htmlContent = '
        <div>
        <p style="font-size:1.25rem; font-weight: 700> NOMCAARRD Supplies Report as of'. $timeStamp .'
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



        // Generate the filename based on the start and end dates of the week
        $filename = 'weekly_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '_' . $timeStamp . '.html';

        // Save the HTML report to storage
        $storagePath = 'reports/' . $filename;
        Storage::put($storagePath, $htmlContent);

        // Display a success message
        $this->info('Weekly report generated successfully.');
    }
}
