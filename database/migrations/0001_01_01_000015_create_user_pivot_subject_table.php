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
        if (!Schema::hasTable('user_pivot_subject')) {
            Schema::create('user_pivot_subject', function (Blueprint $table) {
                $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
                $table->foreignUuid('subject_id')->constrained()->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pivot_subject');
    }
};
