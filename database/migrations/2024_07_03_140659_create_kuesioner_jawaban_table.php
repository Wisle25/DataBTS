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
        Schema::create('kuesioner_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kuesioner');
            $table->text('jawaban');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_kuesioner')->references('id')->on('kuesioner')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('pengguna')->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('pengguna')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuesioner_jawaban');
    }
};
