<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Antrian;
use App\Models\AntrianStore;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Membuat data User
        // for ($i = 0; $i < 20; $i++) {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'password' => bcrypt('1234'),
        //     ]);
        // }

        // // Membuat data Layanan
        // for ($i = 0; $i < 5; $i++) {
        //     Layanan::create([
        //         'nama_layanan' => $faker->word,
        //         'kode' => strtoupper($faker->unique()->lexify('??')),
        //         'deskripsi' => $faker->sentence,
        //         'user_id' => User::inRandomOrder()->first()->id,
        //     ]);
        // }

        // // Membuat data Antrian
        // for ($i = 0; $i < 5; $i++) {
        //     Antrian::create([
        //         'layanan_id' => Layanan::inRandomOrder()->first()->id,
        //         'kuota' => $faker->numberBetween(10, 20),
        //         'user_id' => User::inRandomOrder()->first()->id,
        //         'nama_layanan' => $faker->words(2, true),
        //         'kode' => strtoupper($faker->unique()->lexify('??')),
        //         'deskripsi' => $faker->sentence,
        //         'persyaratan' => $faker->sentence,
        //     ]);
        // }

    //     Membuat data AntrianStore
        for ($i = 0; $i < 100; $i++) {
            $antrian = Antrian::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();
            $tanggal = Carbon::today()->format('Y-m-d');
            $kode_awal = $antrian->kode;
            $kode_urut = str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            $kode = $kode_awal . '-' . $kode_urut;

            AntrianStore::create([
                'user_id' => $user->id,
                'antrian_id' => $antrian->id,
                'tanggal' => $tanggal,
                'kode' => $kode,
                'nama_lengkap' => $faker->name,
                'nomor_hp' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'kuota' => 1,
                'status' => 'daftar',
                'waktu_ambil' => now(),
                'dipanggil_pada' => null,
                'selesai_pada' => null,
            ]);
        }
    // }
    }
}
