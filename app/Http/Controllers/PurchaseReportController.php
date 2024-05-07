<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\PurchaseReport;
use App\Models\Assets;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseReports = PurchaseReport::all();
        $equipments = Equipment::all();
        $assets = Assets::all();
        $employees = Employee::all();
        $categories = Category::all();

        return view('reports.purchaseReport.index', compact('purchaseReports', 'equipments', 'assets', 'employees', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $equipments = Equipment::all();
        return view('reports.purchaseReport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'pr_no' => 'required|integer|unique:purchase_reports',
            'name' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|in:equipment,supplies',
            'employee_id' => 'required|exists:employees,id',
            'equipment_id' => 'required|exists:equipments,id',
        ]);


        // Check if the equipment is already assigned to an employee
        $existingReport = PurchaseReport::where('employee_id', $validatedData['employee_id'])
            ->where('equipment_id', $validatedData['equipment_id'])
            ->first();

        if ($existingReport) {
            return redirect()->back()->withErrors('Equipment already assigned to this employee.');
        }

        // Create a new purchase report
        $purchaseReport = PurchaseReport::create($validatedData);

        return redirect()->route('purchaseReport')
            ->with('success', 'Purchase report created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchaseReports = PurchaseReport::all();
        $equipments = Equipment::all();
        $assets = Assets::all();
        $employees = Employee::all();
        $categories = Category::all();

        return view('reports.purchaseReport.index', compact('purchaseReports', 'equipments', 'assets', 'employees', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'pr_no' => 'required|unique:purchase_reports,pr_no,',
            'name' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);
        $purchaseReport = PurchaseReport::findOrFail($id);

        $purchaseReport->update($request->all());

        return redirect()->route('purchaseReport', compact('purchaseReport'))->with('success', 'Reports updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchaseReport = PurchaseReport::findOrFail($id);
        $purchaseReport->delete();

        return redirect()->route('purchaseReport')->with('success', 'Report deleted successfully');
    }
}
