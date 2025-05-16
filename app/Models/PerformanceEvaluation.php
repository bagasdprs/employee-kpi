<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceEvaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'evaluator_id',
        'period_id',
        'notes',
        'final_score',
        'performance_level',
        'is_finalized',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'final_score' => 'decimal:2',
        'is_finalized' => 'boolean',
    ];

    /**
     * Performance level constants
     */
    public const LEVEL_EXCELLENT = 'excellent';
    public const LEVEL_GOOD = 'good';
    public const LEVEL_SATISFACTORY = 'satisfactory';
    public const LEVEL_NEEDS_IMPROVEMENT = 'needs_improvement';
    public const LEVEL_POOR = 'poor';

    public function employee()
    {
        return $this->belongsTo(EmployeeProfile::class, 'employee_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function period()
    {
        return $this->belongsTo(EvaluationPeriod::class, 'period_id');
    }

    public function criteriaScores()
    {
        return $this->hasMany(CriteriaScore::class, 'evaluation_id');
    }

    public function calculateFinalScore()
    {
        $totalScore = 0;
        $totalWeight = 0;

        foreach ($this->criteriaScores as $score) {
            $criteria = $score->criteria;
            $totalScore += $score->score * $criteria->weight;
            $totalWeight += $criteria->weight;
        }

        $finalScore = $totalWeight > 0 ? $totalScore / $totalWeight : 0;
        $this->final_score = $finalScore;

        // Set performance level based on final score
        $this->performance_level = $this->calculatePerformanceLevel($finalScore);

        $this->save();

        return $finalScore;
    }

    public function calculatePerformanceLevel($score)
    {
        if ($score >= 90) {
            return self::LEVEL_EXCELLENT;
        } elseif ($score >= 80) {
            return self::LEVEL_GOOD;
        } elseif ($score >= 70) {
            return self::LEVEL_SATISFACTORY;
        } elseif ($score >= 60) {
            return self::LEVEL_NEEDS_IMPROVEMENT;
        } else {
            return self::LEVEL_POOR;
        }
    }

    public function finalize()
    {
        $this->calculateFinalScore();
        $this->is_finalized = true;
        $this->save();

        return $this;
    }
}
