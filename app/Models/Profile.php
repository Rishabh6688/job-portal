<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'phone', 'location', 'bio', 'skills', 'experience', 'user_id'
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, if you want to use timestamps (if you haven't disabled them)
    public $timestamps = true; 
}
