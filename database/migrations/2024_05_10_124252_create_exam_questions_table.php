<?php

use App\Enums\ExamAnswerTypeEnum;
use App\Enums\ModelStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary;
            $table->string('name');
            $table->string('status')->default(ModelStatusEnum::DRAFT);
            $table->foreignUuid('exam_pattern_id')->nullable();
            $table->foreignUuid('exam_subject_id')->nullable();
            $table->foreignUuid('exam_difficulty_id')->nullable();
            $table->text('question')->nullable();
            $table->text('solution')->nullable();
            $table->string('answer_type')->default(ExamAnswerTypeEnum::RADIO);
            $table->string('correct_answer')->nullable();
            $table->text('answer')->nullable();
            $table->text('answer1')->nullable();
            $table->text('answer2')->nullable();
            $table->text('answer3')->nullable();
            $table->text('answer4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
