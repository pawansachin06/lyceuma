<?php

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
        // Schema::create('exams', function (Blueprint $table) {
        //     $table->uuid('id')->unique()->primary;
        //     $table->string('name');
        //     $table->string('table')->nullable();
        //     $table->uuid('exam_category_id')->nullable();
        //     $table->uuid('exam_type_id')->nullable();
        //     $table->integer('duration')->unsigned()->default(1);
        //     $table->date('date')->nullable();
        //     $table->time('start_time')->nullable();
        //     $table->time('end_time')->nullable();
        //     $table->text('difficulties')->nullable();
        //     $table->integer('order')->unsigned()->default(0);
        //     $table->string('status')->default(ModelStatusEnum::DRAFT);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
