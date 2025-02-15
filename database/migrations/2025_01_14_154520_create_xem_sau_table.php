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
        Schema::create('see_later', function (Blueprint $table) {  //xem sau
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_post');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_post')->references('id')->on('post');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('see_later');
    }
};
