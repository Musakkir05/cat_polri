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
        Schema::create('jawabs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('id_soal');
            $table->integer('id_user');
            $table->integer('id_paket')->nullable();
            $table->string('nama', 255)->nullable();
            $table->string('pilihan1', 5);
            $table->string('pilihan2', 5)->nullable();
            $table->decimal('score')->nullable();
            $table->string('status', 1)->nullable();
            $table->integer('revisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawabs');
    }
};
