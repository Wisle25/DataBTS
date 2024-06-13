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
            $table->text('kondisi_bts');
            $table->unsignedBigInteger('id_user_surveyor')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('edited_at')->useCurrent()->nullable();
            $table->timestamps();

            $table->foreign('id_bts')->references('id')->on('bts');
            // $table->foreign('id_user_surveyor')->references('id')->on('users');
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
