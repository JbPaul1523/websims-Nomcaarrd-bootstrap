<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = Equipment::all();
        $employees = Employee::all();
        $categories = Category::all();

        return view(' items.equipment.index', compact('equipments','employees', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('items.equipment.create', compact( 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'condition' => ['required', Rule::in(['good', 'condemned'])],
            'amount' => 'required|numeric|between:0,9999999.99', // Adjust the range as needed
            'description' => 'nullable|string',
            'date_acquired' => 'required|date',
            'employees_id' =>'required|exists:employees,id',
            'categories_id'=> 'required|exists:categories,id'
        ]);

        Equipment::create($request->all());

        return redirect()->route('equipments')->with('success', 'Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipments = Equipment::findOrFail($id);
        $employees = Employee::all();
        $categories = Category::all();
        return view('items.equipment.edit', compact('equipments','employees'  ,'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'condition' => ['required', Rule::in(['good', 'condemned'])],
            'amount' => 'required|numeric|between:0,9999999.99', // Adjust the range as needed
            'description' => 'nullable|string',
            'date_acquired' => 'required|date',
            'employees_id'=>'required|exists:employees,id',
            'categories_id'=> 'required|exists:categories,id'
        ]);
        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->all());

        return redirect(route('equipments'))->with('success', 'Item updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return redirect(route('equipments'))->with('success', 'Item deleted successfully');
    }
}
