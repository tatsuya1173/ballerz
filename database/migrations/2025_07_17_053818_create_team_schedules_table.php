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
        // database/migrations/xxxx_xx_xx_create_team_schedules_table.php
        Schema::create('team_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->date('date'); // 開催日
            $table->time('start_time')->nullable(); // 開始時間（任意）
            $table->time('end_time')->nullable();   // 終了時間（任意）
            $table->string('title');                // イベント名（例：練習・練習試合）
            $table->text('memo')->nullable();       // 備考
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_schedules');
    }
};
