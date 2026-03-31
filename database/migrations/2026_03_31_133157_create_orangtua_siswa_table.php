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
        Schema::create('orangtua_siswa', function (Blueprint $table) {
            $table->id('id_wali');
            $table->string('nis', 20);
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->string('nama_wali', 100);
            $table->string('status_hubungan', 20);
            $table->string('pekerjaan', 50);
            $table->string('no_hp', 15);
            $table->text('alamat_wali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtua_siswa');
    }
};
