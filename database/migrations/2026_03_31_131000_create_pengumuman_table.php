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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id('id_pengumuman');
            $table->string('judul_pengumuman', 255);
            $table->text('isi_pengumuman');
            $table->enum('prioritas', ['Normal', 'Tinggi', 'Sangat Tinggi'])->default('Normal');
            $table->string('target', 255);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->time('waktu_publikasi')->nullable();
            $table->enum('status', ['Publish', 'Draft', 'Arsip'])->default('Draft');
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_pengumuman')->onDelete('restrict');
            $table->unsignedBigInteger('id_pembuat');
            $table->foreign('id_pembuat')->references('id_user')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
            $table->dropForeign(['id_pembuat']);
        });
        
        Schema::dropIfExists('pengumuman');
    }
};
