<?php

namespace App\Http\Controllers;

use App\Models\PrItem;
use Illuminate\Http\Request;

class PrItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $items = PrItem::all();
        return view('purchaseReport.Items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('purchaseReport.Items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required'
        ]);

        PrItem::create($request->all());
        return redirect()->route('PrItem')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(PrItem $item)
    {
        return view('purchaseReport.Items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        return view('purchaseReport.Items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required'
        ]);

        $item = PrItem::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('PrItem')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy( $id)
    {
        $item = PrItem::findOrFail($id);
        $item->delete();
        return redirect(route('PrItem'))->with('success', 'Item deleted successfully');
    }
}
