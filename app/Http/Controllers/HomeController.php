<?php

namespace App\Http\Controllers;

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
        return view('dashboard.index', compact('userCount','employeeCount', 'equipmentCount',  'categoryCount', 'supplyCount'));
    }
}
