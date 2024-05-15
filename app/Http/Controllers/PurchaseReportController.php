<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReport;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $purchaseReports = PurchaseReport::all();
        return view('purchaseReport.index', compact('purchaseReports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('purchaseReports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'pr_no' => 'required|unique:purchase_reports',
            'name' => 'required',
            'fund_cluster' => 'required',
            'purpose' => 'required',
            'pr_categories_id' => 'nullable|exists:pr_categories,id',
            'pr_items_id' => 'nullable|exists:pr_items,id',
            'pr_signatories_id' => 'nullable|exists:pr_signatories,id',
        ]);

        PurchaseReport::create($request->all());
        return redirect()->route('purchaseReports.index')->with('success','Purchase report created successfully.');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(PurchaseReport $purchaseReport)
    {
        return view('purchaseReports.show', compact('purchaseReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(PurchaseReport $purchaseReport)
    {
        return view('purchaseReports.edit', compact('purchaseReport'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, PurchaseReport $purchaseReport)
    {
        $request->validate([
            'pr_no' => 'required|unique:purchase_reports,pr_no,' . $purchaseReport->id,
            'name' => 'required',
            'fund_cluster' => 'required',
            'purpose' => 'required',
            'pr_categories_id' => 'nullable|exists:pr_categories,id',
            'pr_items_id' => 'nullable|exists:pr_items,id',
            'pr_signatories_id' => 'nullable|exists:pr_signatories,id',
        ]);

        $purchaseReport->update($request->all());
        return redirect()->route('purchaseReports.index')->with('success','Purchase report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(PurchaseReport $purchaseReport)
    {
        $purchaseReport->delete();
        return redirect()->route('purchaseReports.index')->with('success', 'Purchase report deleted successfully');
    }
}
