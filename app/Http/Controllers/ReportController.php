<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Assets;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        $employees = Employee::all();
        $assets = Assets::all();
        $equipment = Equipment::all();

        return view('reports.sumReport.index', compact('reports','employees','assets','equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reports = Report::all();
        $employees = Employee::all();
        $assets = Assets::all();
        $equipment = Equipment::all();

        return view('reports.sumReport.create', compact('reports','employees','assets','equipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'employees_id' => 'nullable|exists:employees,id',
            'equipments_id' => 'nullable|exists:equipments,id',
            'assets_id' => 'nullable|exists:assets,id',
        ]);

        Report::create($request->all());

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
