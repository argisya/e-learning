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
        Schema::create('orangtuasiswa', function (Blueprint $table) {
            $table->id('id_orangtua_siswa');
            $table->string('nis', 20)->nullable();
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('set null');
            $table->foreignId('id_orangtua')->nullable()->constrained('orangtua', 'id_orangtua')->onDelete('set null');
            $table->enum('status_hubungan', ['Ayah', 'Ibu', 'Wali']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orangtuasiswa', function (Blueprint $table) {
            $table->dropForeign(['nis']);
            $table->dropForeign(['id_orangtua']);
        });

        Schema::dropIfExists('orangtuasiswa');
    }
};
