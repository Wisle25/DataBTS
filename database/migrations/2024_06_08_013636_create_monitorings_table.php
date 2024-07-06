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
        Schema::create('monitoring', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('tahun');
            $table->unsignedBigInteger('id_bts');
            $table->text('tgl_generate');
            $table->text('tgl_kunjungan');
            $table->unsignedBigInteger('id_kondisi_bts');
            $table->unsignedBigInteger('id_user');
            $table->string('created_by')->nullable(); 
            $table->string('edited_by')->nullable(); 
            $table->timestamps();

            $table->foreign('id_bts')->references('id')->on('bts');
            $table->foreign('id_kondisi_bts')->references('id')->on('kondisi_bts');
            $table->foreign('id_user')->references('id')->on('pengguna')->after('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};
