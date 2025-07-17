<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard or redirect to profile creation if not exists.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->profile) {
            return redirect()->route('profile.create')->with('info', 'Please complete your profile first.');
        }

        return view('dashboard', ['profile' => $user->profile]);
    }
}
    