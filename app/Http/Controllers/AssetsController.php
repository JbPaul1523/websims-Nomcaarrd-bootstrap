<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Illuminate\Http\Request;

use App\Events\SupplyUpdated;
use App\Models\AssetDeduction;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Assets::all();
        // $transactions = SupplyTransaction::all();
        return view('items.supplies.index', compact('assets'));
    }

    public function suppliesReportIndex()
    {
        $assets = Assets::all();
        return view('reports.suppliesReport.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.supplies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0', // Assuming amount cannot be negative
            'stock' => 'required|integer|min:0', // Assuming stock cannot be negative
            'date_acquired' => 'required|date',
        ]);

        Assets::create($request->all());

        return redirect()->route('supplies')->with('success', 'Asset added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asset = Assets::with('deductions')->findOrFail($id);

        if (request()->ajax()) {
            return view('items.supplies.show', compact('asset'))->render();
        }

        return view('items.supplies.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assets = Assets::findOrFail($id);
        return view('items.supplies.index', compact('assets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        $supply = Assets::findOrFail($id);
        $quantityToDeduct = $request->input('stock');

        // Fire the event to deduct the quantity
        event(new SupplyUpdated($supply, $quantityToDeduct));

        return redirect()->route('supplies.index')->with('success', 'Supply updated and quantity deducted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assets = Assets::findOrFail($id);
        $assets->delete();

        return redirect(route('supplies'))->with('success', 'Item deleted successfully');
    }

    public function deduct(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $asset = Assets::findOrFail($id);

        if ($asset->stock < $request->stock) {
            return redirect()->back()->with('error', 'Insufficient stock to deduct the requested amount.');
        }

        $deductedAmount = $request->stock;
        $asset->stock -= $deductedAmount;
        $asset->save();

        // Save deduction history
        AssetDeduction::create([
            'asset_id' => $asset->id,
            'deducted_amount' => $deductedAmount,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Stock deducted successfully.');
    }

    public function getDeductForm($id)
    {
        $asset = Assets::findOrFail($id);

        if (request()->ajax()) {
            return view('items.supplies.deduct-form', compact('asset'))->render();
        }
    }

}
