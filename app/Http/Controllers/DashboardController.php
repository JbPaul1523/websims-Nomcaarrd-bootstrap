<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        return view(
            'dashboard.index',
            ['$userCount' => $userCount]
        );
    }
}
