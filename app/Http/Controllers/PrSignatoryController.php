<?php

namespace App\Http\Controllers;

use App\Models\PrSignatory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrSignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $signatories = PrSignatory::all();
        return view('purchaseReport.Signatories.index', compact('signatories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('purchaseReport.Signatories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'position' => ['required', Rule::in(['NOMCAARRD Director', 'University President'])],
        ]);

        PrSignatory::create($request->all());
        return redirect()->route('PrSignatory')->with('success', 'Signatory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     */
    // public function show(PrSignatory $signatory)
    // {
    //     return view('purchaseReport.Signatories.show', compact('signatory'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $signatory = PrSignatory::findOrFail($id);
        return view('purchaseReport.Signatories.edit', compact('signatory'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => ['required', Rule::in(['NOMCAARRD Director', 'University President'])],
        ]);
        $signatory= PrSignatory::findOrFail($id);
        $signatory->update($request->all());
        return redirect()->route('PrSignatory')->with('success', 'Signatory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $signatory = PrSignatory::findOrFail($id);
        $signatory->delete();
        return redirect()->route('PrSignatory')->with('success', 'Signatory deleted successfully');
    }
}
