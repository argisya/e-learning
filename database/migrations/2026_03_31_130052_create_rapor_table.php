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
        Schema::create('rapor', function (Blueprint $table) {
            $table->id('id_rapor');
            $table->string('nis', 20);
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->enum('semester', ['1', '2']);
            $table->string('tahun', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapor', function (Blueprint $table) {
            $table->dropForeign(['nisn']);
            $table->dropIndex('nisn');

        });

        Schema::dropIfExists('rapor');
    }
};
