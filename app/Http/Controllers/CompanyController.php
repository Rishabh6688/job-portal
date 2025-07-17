<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // Start base query to filter jobs
        $query = Job::query();

        // Filter by job title (role)
        if ($request->filled('title')) {
            $query->where('role', 'like', '%' . $request->title . '%');
        }

        // Filter by keywords (in job description)
        if ($request->filled('keywords')) {
            $query->where('description', 'like', '%' . $request->keywords . '%');
        }

        // Filter by company name
        if ($request->filled('company_name')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->company_name . '%');
            });
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Get the filtered list of jobs along with their companies
        $jobs = $query->with('company')->get();

        // Get all unique job roles for the filter dropdown
        $allRoles = Job::select('role')->distinct()->pluck('role');

        // Fetch the user's profile if it exists
        $profile = Auth::user()->profile ?? null;

        return view('jobs.index', compact('jobs', 'profile', 'allRoles'));
    }

    public function apply($jobId)
    {
        // Get the job by ID
        $job = Job::findOrFail($jobId);
        $user = Auth::user();

        // Prevent duplicate applications
        if ($user->applications()->where('job_id', $job->id)->exists()) {
            return redirect()->route('jobs.index')->with('error', 'You have already applied to this job.');
        }

        // Attach user to job
        $user->applications()->attach($job->id);

        // Redirect to success page
        return redirect()->route('application.thank-you')->with('success', 'Application submitted.');
    }

    public function applicationSuccess()
    {
        return view('application-success');
    }
    // app/Http/Controllers/CompanyController.php

public function companiesDashboard()
{
    // Fetch all companies or perform any other logic as required
    $companies = Company::all();

    // Return the view for the companies dashboard
    return view('companies.dashboard', compact('companies'));
}
public function show($id)
{
    // Simulate the same locations as used in Blade
    $locations = [
        'Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata',
        'Hyderabad', 'Pune', 'Ahmedabad', 'Chandigarh', 'Jaipur',
        'Lucknow', 'Indore', 'Coimbatore', 'Nagpur', 'Surat',
        'Visakhapatnam', 'Vadodara', 'Noida', 'Kochi', 'Bhopal'
    ];

    // Create demo data for this specific company ID
    $company = [
        'id' => $id,
        'name' => "Demo Company $id",
        'role' => "Role for Demo $id",
        'experience' => rand(1, 5),
        'description' => "This is a demo description for Demo Company $id offering a position in various fields with potential career growth.",
        'location' => $locations[array_rand($locations)],
    ];

    return view('companies.show', compact('company'));
}



}
