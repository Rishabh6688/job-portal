<!-- resources/views/profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            background: white;
            padding: 25px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .back-link {
            margin-top: 10px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Your Profile</h2>

        <form action="{{ route('profile.update', Auth::user()->profile->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" required>

            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $profile->location) }}" required>

            <label>Bio</label>
            <textarea name="bio" rows="4" required>{{ old('bio', $profile->bio) }}</textarea>

            <label>Skills</label>
            <input type="text" name="skills" value="{{ old('skills', $profile->skills) }}" required>

            <label>Experience (years)</label>
            <input type="number" name="experience" value="{{ old('experience', $profile->experience) }}" required>

            <button class="btn" type="submit">Update Profile</button>
        </form>

        <a class="back-link" href="{{ route('dashboard') }}">← Back to Dashboard</a>
    </div>
</body>
</html>
