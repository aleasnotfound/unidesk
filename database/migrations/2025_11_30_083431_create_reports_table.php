<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa')->nullable(); // null jika anonim
            $table->string('nim')->nullable();            // null jika anonim
            $table->string('jurusan');
            $table->string('fasilitas');
            $table->text('keluhan');
            $table->string('foto')->nullable();           // Opsional
            $table->boolean('is_anonymous')->default(false);
            // Status
            $table->enum('status', ['Baru', 'Diproses', 'Menunggu', 'Selesai'])->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};