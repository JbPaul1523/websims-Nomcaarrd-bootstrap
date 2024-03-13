<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $userCount = User::count();
        $employeesCount = Employee::count();

        return view(
            'dashboard.index',
            ['$userCount' => $userCount],

        );
    }
}
