<?php
namespace App\Http\Controllers;

use App\Models\EquipmentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
