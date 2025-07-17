resources/views/jobs/index.blade.php
@extends('layouts.app') {{-- Adjust layout if different --}}

@section('content')
<div class="container mt-5">
    <h2>Available Jobs</h2>

    {{-- Back to Companies Button --}}
    <div class="mb-3">
        <a href="{{ route('companies.dashboard') }}" class="btn btn-primary">
            Back to Companies
        </a>
    </div>

    {{-- Display success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Display error message --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Display jobs if available --}}
    @if($jobs->count())
        @foreach($jobs as $job)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>{{ $job->role }}</h4>
                    <p>{{ $job->description }}</p>
                    <p><strong>Company:</strong> {{ $job->company->name ?? 'N/A' }}</p>
                    <p><strong>Location:</strong> {{ $job->location }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>No jobs found.</p>
    @endif
</div>
@endsection
