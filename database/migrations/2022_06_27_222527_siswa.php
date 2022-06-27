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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nomor_induk');
            $table->string('alamat');
            $table->string('jenis_kelamin');
            $table->string('berkas1');
            $table->string('berkas2');
            $table->string('berkas3');
            $table->integer('id_jenis_pelayanan')->default(0);
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
        Schema::dropIfExists('tb_siswa');
    }
};
