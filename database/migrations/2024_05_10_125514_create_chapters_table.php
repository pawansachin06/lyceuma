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
        Schema::create('chapters', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary;
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->uuid('subject_id')->nullable();
            $table->uuid('parent_id')->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->string('status')->default(ModelStatusEnum::DRAFT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
