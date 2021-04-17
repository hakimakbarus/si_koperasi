<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // \App\Models\User::factory(10)->create();
        $faker = \Faker\Factory::create('id_ID');

        // for ($i = 1; $i <= 50; $i++) {

        // insert data ke table pegawai menggunakan Faker
        DB::table('users')->insert([
            'name' => 'Hakim Akbaru Sulthony',
            'email' => 'hakim@superadmin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'jenis_kelamin' => 'L',
            'role' => 'super admin',
            'alamat' => $faker->address,
            'telepon' => $faker->phoneNumber,
            'created_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Akbaru Maulana',
            'email' => 'akbar@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'jenis_kelamin' => 'L',
            'role' => 'admin',
            'alamat' => $faker->address,
            'telepon' => $faker->phoneNumber,
            'created_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Nur Aini',
            'email' => 'aini@bendahara.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'jenis_kelamin' => 'P',
            'role' => 'bendahara',
            'alamat' => $faker->address,
            'telepon' => $faker->phoneNumber,
            'created_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // DB::table('users')->insert([
        //     'name' => $faker->name,
        //     'email' => $faker->unique()->safeEmail,
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'role' => 'super admin',
        //     'alamat' => $faker->address,
        //     'telepon' => $faker->phoneNumber,
        //     'created_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);
        // }
    }
}
