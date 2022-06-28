<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_instansi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pendaftar');
            $table->string('nama_instansi');
            $table->string('alamat_instansi');
            $table->string('gambar_instansi');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->integer('is_deleted')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_instansi');
    }
};
