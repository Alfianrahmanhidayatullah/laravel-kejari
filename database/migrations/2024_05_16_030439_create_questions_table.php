<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id'); // Ensure this matches the type of `materi.id`

            // $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('question_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
