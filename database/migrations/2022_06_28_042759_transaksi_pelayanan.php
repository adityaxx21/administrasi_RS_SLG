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
        Schema::create('tb_transaksi_pelayanan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_instansi')->default(0);
            $table->integer('id_jenis_pelayanan')->default(0);
            $table->integer('durasi _pelayanan')->default(0);
            $table->integer('jumlah _pelayanan')->default(0);
            $table->integer('total_biaya_pelayanan')->default(0);
            $table->string('kode_pembayaran')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('id_status_pembayaran')->default(1);
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
        Schema::dropIfExists('tb_transaksi_pelayanan');
    }
};
