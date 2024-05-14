<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Controller on login function here
     * Expand for future updates
     */
    public function uponLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful
            // Redirect to the desired page after login
            return redirect()->route('admin.dashboard');
        }
    }
}
