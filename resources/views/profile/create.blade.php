<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f4a8c0, #f8c1d1); /* Pink gradient */
            padding: 20px;
            margin: 0;
        }
        h2 {
            text-align: center;
            color: #c0397d;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            color: #444;
        }

        input, textarea, button, .back-btn {
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus, textarea:focus {
            border-color: #e91e63;
            outline: none;
        }

        button {
            background-color: #e91e63;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #c2185b;
        }

        .back-btn {
            display: inline-block;
            background-color: #ccc;
            color: #333;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: #999;
        }
    </style>
</head>
<body>

<h2>Create Your Profile</h2>

<div class="form-container">
    {{-- Display success message --}}
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.store') }}">
        @csrf

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Location" required>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio" placeholder="Tell us about yourself" required>{{ old('bio') }}</textarea>

        <label for="skills">Skills:</label>
        <input type="text" id="skills" name="skills" value="{{ old('skills') }}" placeholder="Skills" required>

        <label for="experience">Experience (in years):</label>
        <input type="number" id="experience" name="experience" value="{{ old('experience') }}" placeholder="Experience" min="0" required>

        <button type="submit">Save Profile</button>
        <a href="{{ url()->previous() }}" class="back-btn">Go Back</a>
    </form>
</div>

</body>
</html>
