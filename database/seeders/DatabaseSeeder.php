<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\role;
use App\Models\siswa;
use App\Models\guru;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        role::create([
            'nama_role' => 'Admin'
        ]);

        User::create([
            'id_role' => 1,
            'username' => 'admin',
            'password' => bcrypt('password123'),
            'email' => 'admin@gmail.com'
        ]);
    }
}
