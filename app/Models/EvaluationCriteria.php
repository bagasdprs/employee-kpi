<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationCriteria extends Model
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
        'weight',
        'category_id',
    ];

    /**
     * Get the category that owns the criteria.
     */
    public function category()
    {
        return $this->belongsTo(CriteriaCategory::class, 'category_id');
    }

    /**
     * Get the scores for this criteria.
     */
    public function scores()
    {
        return $this->hasMany(CriteriaScore::class, 'criteria_id');
    }
}
