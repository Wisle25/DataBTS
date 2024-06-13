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
        Schema::create('bts_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bts');
            $table->string('path_foto');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('edited_at')->useCurrent()->nullable();
            $table->timestamps();

            $table->foreign('id_bts')->references('id')->on('bts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bts_foto');
    }
};
