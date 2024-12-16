<?php

namespace App\Exports;

use App\Models\QuizAttempts;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QuizAttemptsExport implements FromView
{
    protected $quizzes_id;
    protected $pelatihan_id;

    public function __construct($quizzes_id, $pelatihan_id = null)
    {
        $this->quizzes_id = $quizzes_id;
        $this->pelatihan_id = $pelatihan_id;
    }

    public function view(): View
    {
        $query = QuizAttempts::join('user', 'user.id', '=', 'quiz_attempts.user_id')
            ->where('quiz_attempts.quizzes_id', '=', $this->quizzes_id)
            ->select('quiz_attempts.*', 'user.nama_lengkap');

        if ($this->pelatihan_id) {
            $query->where('user.pelatihan_id', '=', $this->pelatihan_id);
        }

        $listQuizAttempt = $query->orderBy('score', 'desc')->get();

        return view('exports.quiz_attempts', compact('listQuizAttempt'));
    }
}
