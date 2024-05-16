<?php

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
        Schema::create('question_tables', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary;
            $table->string('name');
            $table->string('table');
            $table->uuid('exam_class_id')->nullable();
            $table->uuid('exam_subject_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_tables');
    }
};
