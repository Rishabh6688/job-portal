<!DOCTYPE html>
<html>
<head>
    <title>Application Successful</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .success-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success-box h1 { color: #28a745; }
        .btn {
            margin-top: 20px;
            padding: 10px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="success-box">
        <h1>🎉 Application Submitted!</h1>
        <p>Thank you for applying. We’ll get back to you soon.</p>
        <a href="{{ route('dashboard') }}" class="btn">Back to Listings</a>
    </div>
</body>
</html>
