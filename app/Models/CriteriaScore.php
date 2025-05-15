<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaScore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'evaluation_id',
        'criteria_id',
        'score',
        'comment',
    ];

    /**
     * Get the evaluation that owns the score.
     */
    public function evaluation()
    {
        return $this->belongsTo(PerformanceEvaluation::class, 'evaluation_id');
    }

    /**
     * Get the criteria that is being scored.
     */
    public function criteria()
    {
        return $this->belongsTo(EvaluationCriteria::class, 'criteria_id');
    }
}
