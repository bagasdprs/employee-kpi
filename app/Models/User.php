<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Role constants
     */
    public const ROLE_ADMIN_HR = 'admin_hr';
    public const ROLE_DIVISION_HEAD = 'division_head';
    public const ROLE_EMPLOYEE = 'employee';

    /**
     * Get the employee profile associated with the user.
     */
    public function employeeProfile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    /**
     * Get the evaluations performed by this user.
     */
    public function evaluationsPerformed()
    {
        return $this->hasMany(PerformanceEvaluation::class, 'evaluator_id');
    }

    /**
     * Check if user is admin HR
     */
    public function isAdminHR()
    {
        return $this->role === self::ROLE_ADMIN_HR;
    }

    /**
     * Check if user is division head
     */
    public function isDivisionHead()
    {
        return $this->role === self::ROLE_DIVISION_HEAD;
    }

    /**
     * Check if user is employee
     */
    public function isEmployee()
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }
}
