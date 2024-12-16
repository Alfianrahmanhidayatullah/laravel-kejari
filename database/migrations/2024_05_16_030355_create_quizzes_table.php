<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('materi_id'); // Ensure this matches the type of `materi.id`
            $table->string('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_answer');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
