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
        Schema::create('kategori_pengumuman', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->unsignedBigInteger('id_pengumuman');
            $table->foreign('id_pengumuman')->references('id_pengumuman')->on('pengumuman')->onDelete('cascade');
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_pengumuman', function (Blueprint $table) {
            $table->dropForeign(['id_pengumuman']);
            $table->dropIndex('id_pengumuman');
            
            $table->dropForeign(['id_role']);
            $table->dropIndex('id_role');
        });

        Schema::dropIfExists('kategori_pengumuman');
    }
};
