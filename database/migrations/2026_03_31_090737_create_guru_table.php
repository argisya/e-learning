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
        Schema::create('guru', function (Blueprint $table) {
            $table->string('nip', 20)->primary();
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('restrict');
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 255);
            $table->string('status_pernikahan', 255);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->string('foto', 255)->nullable();
            $table->string('bidang_studi', 255);
            $table->string('golongan', 255);
            $table->string('masa_kerja', 255);
            $table->string('jabatan', 255);
            $table->string('no_sk', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropIndex(['id_user']);
        });
        
        Schema::dropIfExists('guru');
    }
};
