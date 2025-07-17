<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * One-to-One: User has one Profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Check if the user has a profile
     */
    public function hasProfile()
    {
        return $this->profile !== null;
    }

    /**
     * Many-to-Many: User has applied to many Jobs
     */
   public function applications()
{
    return $this->hasMany(Application::class);
}

    public function appliedCompanies()
{
    return $this->belongsToMany(Company::class, 'applications'); // 'applications' is the pivot table
}

}
