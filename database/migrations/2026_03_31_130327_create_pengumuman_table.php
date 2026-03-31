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
            $table->date('tanggal_pengumuman');
            $table->enum('status', ['Aktif', 'Arsip'])->default('Arsip');
            $table->unsignedBigInteger('id_pembuat');
            $table->foreign('id_pembuat')->references('id_user')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropForeign(['id_pembuat']);
            $table->dropIndex('id_pembuat');
        });
        
        Schema::dropIfExists('pengumuman');
    }
};
