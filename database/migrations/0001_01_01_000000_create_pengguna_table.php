<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nama')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('peran')->default('Administrator');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp("edited_at")->default(now());
            $table->timestamps();
    
            // $table->foreign('created_by')->references('id')->on('pengguna');
            // $table->foreign('edited_by')->references('id')->on('pengguna');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
