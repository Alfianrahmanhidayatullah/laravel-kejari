<?php

namespace App\Imports;

use App\Models\Questions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    protected $quiz_id;

    public function __construct($quiz_id)
    {
        $this->quiz_id = $quiz_id;
    }

    public function model(array $row)
    {
        return new Questions([
            'quizzes_id' => $this->quiz_id,
            'question' => $row['question'],
            'option_a' => $row['option_a'],
            'option_b' => $row['option_b'],
            'option_c' => $row['option_c'],
            'option_d' => $row['option_d'],
            'option_e' => $row['option_e'],
            'correct_answer' => strtoupper($row['correct_answer']),
        ]);
    }
}
