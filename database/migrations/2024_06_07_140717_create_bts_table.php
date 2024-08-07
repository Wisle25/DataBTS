<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/YYYY_MM_DD_create_bts_table.php
    public function up()
    {
        Schema::create('bts', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nama');
            $table->text('alamat');
            $table->unsignedBigInteger('id_jenis_bts');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->integer('tinggi_tower');
            $table->integer('panjang_tanah');
            $table->integer('lebar_tanah');
            $table->boolean('ada_genset');
            $table->boolean('ada_tembok_batas');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pemilik');
            $table->unsignedBigInteger('id_wilayah');
            $table->string('path_foto')->nullable();
            $table->string('created_by')->nullable(); 
            $table->string('edited_by')->nullable(); 
            $table->timestamps();

            $table->foreign('id_jenis_bts')->references('id')->on('jenis_bts')->after('id_wilayah');
            $table->foreign('id_pemilik')->references('id')->on('pemilik')->after('id_jenis_bts');
            $table->foreign('id_wilayah')->references('id')->on('wilayah')->after('id_pemilik');
            $table->foreign('id_user')->references('id')->on('pengguna')->after('id_user');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bts');
    }
};
