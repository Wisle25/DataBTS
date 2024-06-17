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
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('id_parent')->nullable();
            $table->integer('level');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('edited_at')->useCurrent()->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_parent')->references('id')->on('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};
