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
        Schema::create('detailsoals', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('id_paket');
            $table->string('jenis', 50)->nullable();
            $table->longText('soal');
            $table->string('audio', 255)->nullable();
            $table->longText('pilA');
            $table->longText('pilB');
            $table->longText('pilC');
            $table->longText('pilD');
            $table->longText('pilE');
            $table->string('kunci_jawaban');
            $table->decimal('score');
            $table->integer('id_user')->nullable();
            $table->string('paket', 35)->nullable();
            $table->string('status', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailsoals');
    }
};
