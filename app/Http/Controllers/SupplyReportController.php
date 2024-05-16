<?php

// app/Http/Controllers/SupplyReportController.php

namespace App\Http\Controllers;

use App\Models\SupplyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplyReportController extends Controller
{
    public function index()
    {
        $reports = SupplyReport::all();
        return view('supply_reports.index', compact('reports'));
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
}
