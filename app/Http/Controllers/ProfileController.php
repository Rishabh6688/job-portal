<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * Require authentication for all profile routes.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the appropriate dashboard based on user profile.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Redirect users with a profile to companies dashboard
        if ($profile) {
            $companies = Company::all(); // Fetch all hiring companies
            return view('companies', compact('profile', 'companies'));
        }

        // Users without a profile see default dashboard with prompt
        return view('default');
    }

    /**
     * Show profile creation form if one doesn't exist.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->profile) {
            return redirect()->route('profile.edit')
                ->with('info', 'You already have a profile. You can update it.');
        }

        return view('profile.create');
    }

    /**
     * Store new profile data for the authenticated user.
     */
    public function store(Request $request)
    {
        $this->validateProfile($request);

        $user = Auth::user();

        if ($user->profile) {
            return redirect()->route('profile.edit')
                ->with('info', 'Profile already exists. You can update it.');
        }

        $user->profile()->create($request->only([
            'phone', 'location', 'bio', 'skills', 'experience'
        ]));

        return redirect()->route('dashboard')->with('success', 'Profile created successfully.');
    }

    /**
     * Show profile edit form if profile exists.
     */
    public function edit()
    {
        $profile = Auth::user()->profile;

        if (!$profile) {
            return redirect()->route('profile.create')
                ->with('error', 'No profile found. Please create one first.');
        }

        return view('profile.edit', compact('profile'));
    }

    /**
     * Update existing profile.
     */
    public function update(Request $request)
    {
        $this->validateProfile($request);

        $profile = Auth::user()->profile;

        if (!$profile) {
            return redirect()->route('profile.create')
                ->with('error', 'No profile found. Please create one first.');
        }

        $profile->update($request->only([
            'phone', 'location', 'bio', 'skills', 'experience'
        ]));

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

    /**
     * Validate profile data.
     */
    protected function validateProfile(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'skills' => 'required|string|max:255',
            'experience' => 'required|numeric|min:0',
        ]);
    }
}
