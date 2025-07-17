<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'role', 'description', 'location'];

    /**
     * A job belongs to a company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Users who have applied to this job (Many-to-Many).
     */
    public function applicants()
    {
        return $this->belongsToMany(User::class, 'job_user')->withTimestamps();
    }
    public function applications()
{
    return $this->hasMany(Application::class);
}

}
