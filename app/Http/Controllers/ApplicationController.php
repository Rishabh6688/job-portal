<?php

namespace App\Http\Controllers;


use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Apply to a job
    public function apply($jobId)
    {
        // Ensure user is authenticated
        $user = Auth::user();

        // Check if the user has already applied for this job
        $alreadyApplied = Application::where('user_id', $user->id)
                                      ->where('job_id', $jobId)
                                      ->exists();

        if ($alreadyApplied) {
            // If already applied, redirect back with a message
            return redirect()->back()->with('message', 'You have already applied for this job.');
        }

        // Create a new application
        Application::create([
            'user_id' => $user->id,
            'job_id' => $jobId,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Your application has been submitted successfully!');
    }

    // Optional: View a user's applied jobs (for example)
    public function userApplications()
    {
        $user = Auth::user();
        $applications = $user->applications()->with('job')->get();

        return view('user.applications', compact('applications'));
    }
    public function store($id)
{
    // Logic to store the application — e.g., save to DB

    return redirect()->route('application.success'); // Or wherever your thank-you page is
}

}
