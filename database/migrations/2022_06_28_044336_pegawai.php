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
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('id_pegawai');
            $table->string('berkas1');
            $table->string('berkas2');
            $table->integer('verifikasi_1')->default(1);
            $table->integer('verifikasi_2')->default(1);
            $table->integer('verifikasi_3')->default(1);
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
        //
    }
};
