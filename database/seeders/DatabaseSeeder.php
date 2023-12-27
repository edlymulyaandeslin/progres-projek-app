<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Level;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'level_id' => 4,
            'nama' => 'Edly Mulya Andeslin',
            'email' => 'edlymulyaandeslin@gmail.com',
            'password' => bcrypt('password'),
            'tempat_lahir' => 'Pasir Pengaraian',
            'tanggal_lahir' => '2002-03-09',
            'alamat' => 'Pasir pengaraian, Rokan hulu',
            'agama' => 'islam',
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan' => fake()->jobTitle(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'level_id' => 1,
            'nama' => 'Rian Lesmana',
            'email' => 'rianlesmanaputra@gmail.com',
            'password' => bcrypt('password'),
            'tempat_lahir' => 'Surau Gading',
            'tanggal_lahir' => '2014-03-19',
            'alamat' => 'Pasir pengaraian, Rokan hulu',
            'agama' => 'islam',
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan' => fake()->jobTitle(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'level_id' => 1,
            'nama' => 'Sayyid Jafar',
            'email' => 'sundek@gmail.com',
            'password' => bcrypt('password'),
            'tempat_lahir' => 'Mumbai',
            'tanggal_lahir' => '2010-03-19',
            'alamat' => 'Pasir pengaraian, Rokan hulu',
            'agama' => 'islam',
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan' => fake()->jobTitle(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'level_id' => 2,
            'nama' => 'Laska Prayoga',
            'email' => 'laskaprayoga@gmail.com',
            'password' => bcrypt('password'),
            'tempat_lahir' => 'Dalu Dalu',
            'tanggal_lahir' => '2007-03-19',
            'alamat' => 'Pasir pengaraian, Rokan hulu',
            'agama' => 'islam',
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan' => fake()->jobTitle(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'level_id' => 3,
            'nama' => 'Dina Rahayu',
            'email' => 'dinarahayu@gmail.com',
            'password' => bcrypt('password'),
            'tempat_lahir' => 'Mumbai',
            'tanggal_lahir' => '2010-03-19',
            'alamat' => 'Pasir pengaraian, Rokan hulu',
            'agama' => 'islam',
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan' => fake()->jobTitle(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);


        // Judulprojek::factory(1)->create();

        // Logbook::factory(5)->create();

        // Presentasi::factory(1)->create();

        Level::create([
            'name' => 'mahasiswa'
        ]);

        Level::create([
            'name' => 'mentor'
        ]);

        Level::create([
            'name' => 'koordinator'
        ]);

        Level::create([
            'name' => 'admin'
        ]);
    }
}
