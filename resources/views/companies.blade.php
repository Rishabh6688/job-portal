<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Companies Hiring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }

        .top-bar {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .company-name { font-size: 20px; font-weight: bold; }

        .top-bar-right {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            padding: 6px 10px;
            margin-right: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover { background-color: #b02a37; }

        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            color: white;
        }

        .page-title {
            padding: 20px;
            background-color: #f8f9fa;
            text-align: center;
        }

        .container {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .company {
            border: 2px solid #007bff;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 300px;
            margin: 10px;
        }

        .company:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .company h3 { margin-top: 0; font-size: 22px; font-weight: bold; color: #007bff; }

        .company p { font-size: 16px; color: #333; flex-grow: 1; }

        .company form { margin-top: 10px; }

        .company .btn {
            padding: 10px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            /* margin: 5px; */
        }

        .company .btn:hover { background-color: #218838; }

        .sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 300px;
            height: 100%;
            background-color: #f5f5f5;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
            transition: right 0.3s ease;
            z-index: 999;
        }

        .sidebar.open { right: 0; }

        .close-btn { font-size: 24px; float: right; cursor: pointer; }

        .user-name { font-weight: bold; margin-bottom: 15px; }

        .profile-toggle { font-weight: bold; cursor: pointer; margin-top: 20px; }

        .profile-details { display: none; margin-top: 10px; }

        .filter-form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 6px;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .filter-box {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
        }

        .filter-box label {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .filter-box input {
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .filter-form button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .filter-form button:hover { background-color: #0056b3; }

        .filter-heading {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="company-name">RozGar</div>
    <div class="top-bar-right">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
        <div class="menu-icon" onclick="toggleSidebar()">&#9776;</div>
    </div>
</div>

<div class="page-title">
    <h2>Companies Hiring!</h2>
</div>

<!-- Filter Form -->
<div class="filter-form">
    <div class="filter-heading">Refine Your Job Search</div>

    <form action="{{ route('companies.index') }}" method="GET">
        <div class="filter-row">
            <div class="filter-box">
                <label for="title">Job Title</label>
                <input type="text" name="title" id="title" placeholder="e.g. Developer" value="{{ request('title') }}">
            </div>

            <div class="filter-box">
                <label for="keywords">Keywords</label>
                <input type="text" name="keywords" id="keywords" placeholder="e.g. Laravel, React" value="{{ request('keywords') }}">
            </div>

            <div class="filter-box">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" placeholder="e.g. TCS" value="{{ request('company_name') }}">
            </div>
        </div>

        <div class="filter-box">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" placeholder="Search by location" value="{{ request('location') }}">
        </div>

        <button type="submit">Search</button>
    </form>
</div>

@php
    $locations = [
        'Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata',
        'Hyderabad', 'Pune', 'Ahmedabad', 'Chandigarh', 'Jaipur',
        'Lucknow', 'Indore', 'Coimbatore', 'Nagpur', 'Surat',
        'Visakhapatnam', 'Vadodara', 'Noida', 'Kochi', 'Bhopal'
    ];
@endphp

<!-- Only Demo Companies -->
<div class="container">
    @for ($i = 1; $i <= 20; $i++)
        <div class="company">
            <h3>Demo Company {{ $i }}</h3>
            <p><strong>Role:</strong> Role for Demo {{ $i }}</p>
            <p><strong>Experience Required:</strong> {{ rand(1, 5) }} years</p>
            <p><strong>Description:</strong> This is a demo description for Demo Company {{ $i }} offering a position in various fields with potential career growth.</p>
            <p><strong>Location:</strong> {{ $locations[array_rand($locations)] }}</p>
            
          <a href="{{ route('companies.show', ['id' => $i]) }}" class="btn">View & Apply</a>


        </div>
    @endfor
</div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <span class="close-btn" onclick="toggleSidebar()">&times;</span>
    <div class="user-name">{{ Auth::user()->name }}</div>
    <div class="profile-toggle" onclick="toggleProfileDetails()">Profile</div>
    <div id="profile-details" class="profile-details">
        <p><strong>Phone:</strong> {{ $profile->phone }}</p>
        <p><strong>Location:</strong> {{ $profile->location }}</p>
        <p><strong>Bio:</strong> {{ $profile->bio }}</p>
        <p><strong>Skills:</strong> {{ $profile->skills }}</p>
        <p><strong>Experience:</strong> {{ $profile->experience }} years</p>
        <a href="{{ route('profile.edit') }}" class="btn">Edit Profile</a>
    </div>
</div>

<!-- JavaScript -->
<script>
      function handleApply(event) {
        event.preventDefault(); // Stop form from submitting normally
        window.location.href = "{{ route('application.success') }}"; // Redirect to thank-you page
        return false;
    }
    function applyForJob(event, companyId) {
        event.preventDefault();  // Prevent form submission

        const button = event.target;
        button.textContent = 'Applied';  // Change button text
        button.disabled = true;  // Disable the button to prevent multiple clicks

        // You can also make an AJAX request here to handle the backend logic
        // For example:
        // fetch('/apply', {
        //     method: 'POST',
        //     body: JSON.stringify({ companyId: companyId }),
        //     headers: { 'Content-Type': 'application/json' }
        // });
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
    }

    function toggleProfileDetails() {
        const details = document.getElementById('profile-details');
        details.style.display = (details.style.display === 'block') ? 'none' : 'block';
    }
    function handleApply(event) {
    event.preventDefault(); // Prevent default form submission
    window.location.href = "{{ route('application.success') }}"; // Go to thank-you page
    return false;
}

</script>

</body>
</html>
