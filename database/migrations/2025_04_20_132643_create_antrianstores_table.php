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
        Schema::create('antrianstores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('antrian_id')->constrained('antrians')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kode');
            $table->string('nama_lengkap');
            $table->string('nomor_hp');
            $table->string('alamat');
            $table->integer('kuota')->nullable();
            $table->string('status')->default('daftar');
            $table->timestamp('waktu_ambil')->nullable();
            $table->timestamp('dipanggil_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrianstores');
    }
};
