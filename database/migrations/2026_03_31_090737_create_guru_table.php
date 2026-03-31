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
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('nama_guru', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 20);
            $table->string('status_pernikahan', 20);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->string('golongan', 10);
            $table->string('masa_kerja', 20);
            $table->string('jabatan', 50);
            $table->string('no_sk', 50);
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
