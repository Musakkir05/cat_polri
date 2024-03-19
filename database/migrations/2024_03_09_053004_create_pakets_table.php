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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('id_user')->nullable();
            $table->string('jenis', 50)->nullable();
            $table->string('paket', 50)->nullable();
            $table->longText('deskripsi')->nullable();
            $table->decimal('kkm')->nullable();
            $table->string('waktu', 30)->nullable();
            $table->string('tampil', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
