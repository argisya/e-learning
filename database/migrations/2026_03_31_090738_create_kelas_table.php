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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama_kelas', 50);
            $table->string('jenjang_pendidikan', 20);
            $table->string('jurusan', 50);
            $table->string('tingkat', 20);
            $table->string('nip_wali', 20);
            $table->foreign('nip_wali')->references('nip')->on('guru')->onDelete('cascade');
            $table->string('ruangan', 20);
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
