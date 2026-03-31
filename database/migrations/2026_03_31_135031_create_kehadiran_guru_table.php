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
        Schema::create('kehadiran_guru', function (Blueprint $table) {
            $table->id('id_kehadiran');
            $table->string('nip', 20);
            $table->foreign('nip')->references('nip')->on('guru')->onDelete('cascade');
            $table->date('tanggal');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->foreignId('id_mapel')->constrained('mapel', 'id_mapel')->onDelete('cascade');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Tanpa Keterangan'])->default('Tanpa Keterangan');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran_guru');
    }
};
