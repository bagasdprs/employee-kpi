<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'department_id',
        'position_id',
        'join_date',
        'phone_number',
        'address',
        'profile_photo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'join_date' => 'date',
    ];

    /**
     * Get the user that owns the employee profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department that the employee belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position that the employee has.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the performance evaluations for the employee.
     */
    public function evaluations()
    {
        return $this->hasMany(PerformanceEvaluation::class, 'employee_id');
    }

    /**
     * Get the employee's full name (from associated user).
     */
    public function getFullNameAttribute()
    {
        return $this->user->name;
    }
}
