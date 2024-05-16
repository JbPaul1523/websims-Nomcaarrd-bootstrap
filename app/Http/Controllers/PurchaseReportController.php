<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReport;
use App\Models\PrItem;
use App\Models\PrSignatory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $purchaseReports = PurchaseReport::all();
        $prItem = PrItem::all();
        $prSignatory = PrSignatory::all();
        return view('purchaseReport.ManagePr.index', compact('purchaseReports', 'prItem', 'prSignatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $purchaseReport = PurchaseReport::all();
        $prItems = PrItem::all();

        return view('purchaseReport.ManagePr.create', compact('purchaseReport','prItem'));
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
            'category'=> ['required', Rule::in(['supply', 'services', 'equipment'])],

        ]);

        $purchaseReport = PurchaseReport::create($request->except(['pr_items_id', 'pr_signatories_id']));

        if ($request->has('pr_items_id')) {
            $purchaseReport->items()->attach($request->pr_items_id);
        }
        if ($request->has('pr_signatories_id')) {
            $purchaseReport->signatories()->attach($request->pr_signatories_id);
        }

        PurchaseReport::create($request->all());
        return redirect()->route('purchaseReports')->with('success','Purchase report created successfully.');
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
            'pr_no' => 'required|unique:purchase_reports',
            'name' => 'required',
            'fund_cluster' => 'required',
            'purpose' => 'required',
            'category'=> ['required', Rule::in(['supply', 'services', 'equipment'])],
            'pr_items_id' => 'nullable|array',
            'pr_items_id.*' => 'exists:pr_items,id',
            'pr_signatories_id' => 'nullable|array',
            'pr_signatories_id.*' => 'exists:pr_signatories,id',
        ]);

        $purchaseReport = PurchaseReport::create($request->except(['pr_items_id', 'pr_signatories_id']));

        if ($request->has('pr_items_id')) {
            $purchaseReport->items()->attach($request->pr_items_id);
        }
        if ($request->has('pr_signatories_id')) {
            $purchaseReport->signatories()->attach($request->pr_signatories_id);
        }

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
