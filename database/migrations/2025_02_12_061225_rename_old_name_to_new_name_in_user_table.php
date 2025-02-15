<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            // Đổi tên cột từ 'old_name' thành 'new_name'
            $table->renameColumn('name', 'username');
            $table->renameColumn('so_dien_thoai', 'phone_number');
            $table->renameColumn('mat_khau', 'password');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Hoàn tác lại tên cột từ 'new_name' thành 'old_name'
            $table->renameColumn('name', 'username');
            $table->renameColumn('so_dien_thoai', 'phone_number');
            $table->renameColumn('mat_khau', 'password');
        });
    }
};
