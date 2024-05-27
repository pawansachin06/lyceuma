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
        if (!Schema::hasTable('notification_subscribers')) {
            Schema::create('notification_subscribers', function (Blueprint $table) {
                $table->uuid('id')->unique()->primary;
                $table->uuid('user_id')->nullable();
                $table->text('token');
                $table->string('device');
                $table->string('os');
                $table->string('browser');
                $table->string('ip');
                $table->string('type')->default('WEB');
                $table->boolean('disabled')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_subscribers');
    }
};
