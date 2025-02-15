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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title', 55);
            $table->decimal('price', 15, 2);
            $table->integer('year'); // nam san xuat
            $table->integer('mileage'); //so km
            $table->string('mau_xe', 55);
            $table->enum('fuel_type', ['xăng', 'điện', 'dầu']);
            $table->enum('gearbox', ['số sàn', 'số tự động']);
            $table->integer('number_seats'); // so cho ngoi
            $table->enum('status', ['chờ duyệt', 'đã duyệt', 'bị từ chối']);
            $table->string('url_picture', 255);
            $table->unsignedBigInteger('id_design_car');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_car_brand');
            $table->unsignedBigInteger('id_address');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_design_car')->references('id')->on('design_car');
            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_car_brand')->references('id')->on('car_brand');
            $table->foreign('id_address')->references('id')->on('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
