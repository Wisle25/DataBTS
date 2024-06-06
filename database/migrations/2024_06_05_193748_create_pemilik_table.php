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
        Schema::create('pemilik', function (Blueprint $table) {
            $table->id()->primary();
            $table->string("name")->unique();
            $table->text("alamat");
            $table->string("telepon");
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp("edited_at")->default(now());
            $table->timestamps();

            // $table->foreign('created_by')->references('id')->on('pengguna')->onDelete("cascade");
            // $table->foreign('edited_by')->references('id')->on('pengguna')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemiliks');
    }
};
