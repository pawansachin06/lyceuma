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
        if(!Schema::hasTable('photos')){
            Schema::create('photos', function (Blueprint $table) {
                $table->uuid('id')->unique()->primary;
                $table->string('name');
                $table->string('folder');
                $table->string('photoable_type')->nullable();
                $table->string('photoable_id')->nullable();
                $table->string('tag')->nullable();
                $table->text('meta')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
