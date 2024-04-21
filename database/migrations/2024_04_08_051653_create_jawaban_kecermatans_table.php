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
        Schema::create('jawaban_kecermatans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_paket')->nullable();
            $table->integer('id_instruksi')->nullable();
            $table->integer('id_pertanyaan');
            $table->string('pilihan', '5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_kecermatans');
    }
};
