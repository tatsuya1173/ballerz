<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('team_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('team_id')
                ->constrained()
                ->onDelete('cascade'); // チーム削除時に画像も削除

            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->integer('order')->nullable();

            $table->timestamp('created_at')->useCurrent(); // 登録日時のみ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_images');
    }
}

