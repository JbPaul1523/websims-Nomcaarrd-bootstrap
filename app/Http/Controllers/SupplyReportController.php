<?php
namespace App\Http\Controllers;

use App\Models\SupplyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SupplyReportController extends Controller
{
    public function index()
    {
        $this->synchronizeReports();
        return view('supply_reports.index');
    }

    public function getReports(Request $request)
    {
        $period = $request->query('period', 'all');
        $query = SupplyReport::where('file_path', 'like', 'reports/supplyreport/%');

        switch ($period) {
            case 'weekly':
                $query->where('file_name', 'like', 'weekly_supply_report_%');
                break;
            case 'monthly':
                $query->where('file_name', 'like', 'monthly_supply_report_%');
                break;
            case 'annually':
                $query->where('file_name', 'like', 'annual_supply_report_%');
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
        $report = SupplyReport::findOrFail($id);
        return Storage::download($report->file_path, $report->file_name);
    }

    public function destroy($id)
    {
        $report = SupplyReport::findOrFail($id);
        Storage::delete($report->file_path);
        $report->delete();
        return redirect()->route('supply_reports.index')->with('success', 'Report deleted successfully');
    }

    private function synchronizeReports()
    {
        $reports = SupplyReport::all();
        foreach ($reports as $report) {
            if (!Storage::exists($report->file_path)) {
                $report->delete();
            }
        }
    }

    public function view($id)
    {
        $report = SupplyReport::findOrFail($id);
        $path = storage_path('app/' . $report->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
