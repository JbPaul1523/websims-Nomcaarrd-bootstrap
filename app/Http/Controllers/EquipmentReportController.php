<?php
namespace App\Http\Controllers;

use App\Models\EquipmentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EquipmentReportController extends Controller
{
    public function index()
    {
        $this->synchronizeReports();
        return view('equipment_reports.index');
    }

    public function getReports(Request $request)
    {
        $period = $request->query('period', 'all');
        $query = EquipmentReport::where('file_path', 'like', 'reports/equipmentreport/%');

        switch ($period) {
            case 'weekly':
                $query->where('file_name', 'like', 'weekly_equipment_report_%');
                break;
            case 'monthly':
                $query->where('file_name', 'like', 'monthly_equipment_report_%');
                break;
            case 'annually':
                $query->where('file_name', 'like', 'annual_equipment_report_%');
                break;
            case 'all':
            default:
                // No additional filtering for 'all'
                break;
        }

        $reports = $query->get();
        return response()->json($reports);
    }

    public function download($id)
    {
        $report = EquipmentReport::findOrFail($id);
        return Storage::download($report->file_path, $report->file_name);
    }

    public function destroy($id)
    {
        $report = EquipmentReport::findOrFail($id);
        Storage::delete($report->file_path);
        $report->delete();
        return redirect()->route('equipment_reports.index')->with('success', 'Report deleted successfully');
    }

    private function synchronizeReports()
    {
        $reports = EquipmentReport::all();
        foreach ($reports as $report) {
            if (!Storage::exists($report->file_path)) {
                $report->delete();
            }
        }
    }
    public function view($id)
    {
        $report = EquipmentReport::findOrFail($id);
        $path = storage_path('app/' . $report->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    // Returns filtered data object
    public function fitler(Request $request){

        switch($request->date){
            case 'quarterly':
                $currentQuarter = ceil(Carbon::now()->month / 3);
                $startDate = Carbon::now()->startOfQuarter();
                $endDate = Carbon::now()->endOfQuarter();
                break;
            case 'semi-annual':
                $semiAnnualStartMonth = Carbon::now()->month <= 6 ? 1 : 7;
                $startDate = Carbon::now()->startOfYear()->month($semiAnnualStartMonth);
                $endDate = Carbon::now()->endOfYear()->month($semiAnnualStartMonth + 5)->endOfMonth();
                break;
            case 'annual':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            default:
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
        }

        $filter = $request->date;

        $report = EquipmentReport::whereBetween('created_at', [$startDate, $endDate] )->get();

        return back()->compact('report', 'filter');
    }

    public function printReports(){
        $html = '<div style="width: 100%" style="font-family: Arial, Helvetica, sans-serif">
                <div style="margin: auto; display: flex; justify-content:center; align-items:center">
                    <div>
                        <img src="{{ asset("icons/header_logo.png") }}" alt="" srcset=""
                            style="width: 8rem; height: 8rem;">
                    </div>
                    <div style="width: 600px">
                        <span style=" font-size: 1.15rem">REPUBLIC OF THE PHILIPPINES</span>
                        <br>
                        <span style="font-weight: 700;  font-size: 1.15rem">Northern Mindanao Consortium for Agriculture,
                            Aquatic and Natural
                            Resources Research And Development (NOMCAARRD)</span>
                        <p style="font-size:  0.9rem; padding: 0px; margin: 0px; ">Central Mindanao University, University Town,
                            Musuan, Bukidnon</p>
                        <p style="font-size:  0.9rem;  padding: 0px;  margin: 0px">Email address: nomcarrdcmu@gmail.com</p>
                        <p style="font-size: 0.9rem;  padding: 0px;  margin: 0px">Phone: 0917-102-7065</p>
                    </div>
                </div>
                <hr style="width: 80%;">
                <div style="margin: auto; justify-content:center">
                    <p style="text-align: center; font-weight: 700; font-size: 1.15rem">WEEKLY REPORT AS OF MONTH</p>
                    <div style="margin: auto; width: 80%">
                        <span>
                            <i> *Note: Equipments listed below are base on this weeks entry. If the equipment you wish to see is
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
                                    <th style="border: 1px solid black">Date Aquired</th>
                                    <th style="border: 1px solid black">Condition</th>
                                </tr>
                            </thead>';
        $html .='   </table>
                    </div>
                    <br>
                    <div style="margin: auto; justify-content: center; width: 80%; display: flex;">
                        <div style="width: 100%; margin: 10px">
                            <span style="text-align: center">Prepared By: </span>
                            <br>
                            <div style="left: 0px;">
                                <div style="text-align: center">
                                    <span style="font-weight: 700">Name of something of someone</span>
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

    return response()->json($html);
    }

}
