<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Equipment;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all(); // Use the correct model name
        $equipments = Equipment::all();
        return view('user-management.employee.index', compact('employees', 'equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-management.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->save();

        return redirect()->route('employees')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employees = Employee::findOrFail($id);
        $equipments = $employees->equipments;
        return view('user-management.employee.index', compact('employees', 'equipments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('user-management.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        // $employee->name = $request->input('name');
        // $employee->position = $request->input('position');
        // $employee->save();


        return redirect()->route('employees', compact('employee'))->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees')->with('success', 'Item deleted successfully');
    }


    public function printPDF($id)
    {
        $employee = Employee::findOrFail($id);

        $html = '
            <div>
               <p style="font-size: 1.25rem; font-weight: 700"> '. $employee->name .' Equipement Report </p>
            </div>
            <div style="width: 100%;">
                <table border="1" style="border-collapse: collapse; width:100%">
                    <thead>
                        <tr align="left">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Serial Number</th>
                            <th>Date Acquired</th>
                            <th>Condition</th>
                        </tr>
                    </thead>
        ';

        $html .= '<tbody>';
        foreach ($employee->equipments as $item) {
            $html .= '<tr align="left">
                <td style="padding: 5px">' . $item->id . '</td>
                <td style="padding: 5px">' . $item->name . '</td>
                <td style="padding: 5px">' . $item->description . '</td>
                <td style="padding: 5px">' . $item->serial_number . '</td>
                <td style="padding: 5px">' . $item->date_acquired . '</td>
                <td style="padding: 5px">' . $item->condition . '</td>
                </tr>';
        }
        $html .= '</tbody></table></div>';



        //dd($html);
        return response()->json($html);
    }
}
