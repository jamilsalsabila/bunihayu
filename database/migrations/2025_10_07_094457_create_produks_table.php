<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->longText('deskripsi');
            $table->unsignedInteger('harga');
            $table->unsignedTinyInteger('kapasitas');
            $table->string('fasilitas');
            //$table->string('foto', 1024)->nullable();
            $table->enum('tersedia', [0, 1])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_produk');
    }
};
