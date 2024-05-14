<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReport;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Category;
use App\Models\Assets;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $employeeCount = Employee::count();
        $equipmentCount = Equipment::count();
        $supplyCount = Assets::count();
        $categoryCount = Category::count();

        $year = date('Y');

        //dd($year);

        $data = PurchaseReport::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->get();

        // Ensure all months are included with count 0 if no entries exist for that month
        $monthlyData = array_fill(1, 12, 0);
        foreach ($data as $entry) {
            $monthlyData[$entry->month] = $entry->count;
        }

        $employee = Employee::withCount('equipments')->get();

        $label = $employee->pluck('name');
        $values = $employee->sum('equipments_count');



        return view('dashboard.index', compact(
            'userCount',
            'employeeCount',
            'equipmentCount',
            'categoryCount',
            'supplyCount',
            'monthlyData',
            'label',
            'values'
        ));
    }
}
