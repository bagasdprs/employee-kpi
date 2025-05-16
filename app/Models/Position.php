<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the employees with this position.
     */
    public function employees()
    {
        return $this->hasMany(EmployeeProfile::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
