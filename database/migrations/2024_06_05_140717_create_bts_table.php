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
            $table->id();
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
            $table->unsignedBigInteger('id_user_pic');
            $table->unsignedBigInteger('id_pemilik');
            $table->unsignedBigInteger('id_wilayah');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bts');
    }
};
