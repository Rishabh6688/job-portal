<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    // Allow mass assignment for these attributes
    protected $fillable = ['name', 'description'];

    /**
     * The users that belong to the company (Many-to-Many relationship).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user', 'company_id', 'user_id', 'applications')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * One-to-Many relationship: A company has many jobs.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function applications()
{
    return $this->belongsToMany(Company::class, 'applications');
}

}
