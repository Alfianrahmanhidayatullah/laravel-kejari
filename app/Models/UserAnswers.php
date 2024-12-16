<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $quiz_attempt_id
 * @property integer $question_id
 * @property string $chosen_answer
 * @property string $is_correct
 * @property string $created_at
 * @property string $updated_at
 * @property QuizAttempt $quizAttempt
 * @property Question $question
 */
class UserAnswers extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['quiz_attempts_id', 'question_id', 'chosen_answer', 'is_correct', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quizAttempts()
    {
        return $this->belongsTo('App\Models\QuizAttempts');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Questions');
    }
}
