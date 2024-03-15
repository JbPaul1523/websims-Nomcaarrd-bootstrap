<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Assets::all();
        return view('items.supplies.index', compact('assets'));
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
    public function show(Assets $assets)
    {
        //
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0', // Assuming amount cannot be negative
            'stock' => 'required|integer|min:0', // Assuming stock cannot be negative
            'date_acquired' => 'required|date',
        ]);

        $assets = Assets::findOrFail($id);
        $assets->update($request->all());

        return redirect()->route('supplies')->with('success', 'Asset Updated successfully');
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
}
