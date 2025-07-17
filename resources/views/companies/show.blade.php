<!DOCTYPE html>
<html>
<head>
    <title>{{ $company['name'] }} - Job Description</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef2f7;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        strong {
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $company['name'] }}</h1>
    <p><strong>Role:</strong> {{ $company['role'] }}</p>
    <p><strong>Experience Required:</strong> {{ $company['experience'] }} years</p>
    <p><strong>Description:</strong> {{ $company['description'] }}</p>
    <p><strong>Location:</strong> {{ $company['location'] }}</p>

    <form method="POST" action="{{ route('dashboard', ['id' => $company['id']]) }}">
        @csrf
        <button type="submit" class="btn">Apply</button>
    </form>
</div>

</body>
</html>
