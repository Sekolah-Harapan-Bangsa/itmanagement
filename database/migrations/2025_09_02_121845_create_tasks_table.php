<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('item');                  // Item / Pekerjaan
            $table->string('jenis')->nullable();     // Jenis
            $table->string('vendor_pic')->nullable();// Vendor / PIC
            $table->date('deadline');                // Deadline / Tanggal Habis
            $table->integer('sisa_hari')->nullable();// Hitung otomatis
            $table->string('status')->nullable();    // Aktif / H-30 / Kadaluarsa
            $table->text('keterangan')->nullable();  // Keterangan
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
