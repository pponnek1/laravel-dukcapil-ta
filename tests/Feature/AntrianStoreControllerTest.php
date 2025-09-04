<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Antrian;
use App\Models\AntrianStore;

class AntrianStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_antrian()
    {
        // Buat user dan antrian dulu
        $user = User::factory()->create();
        $antrian = Antrian::factory()->create(['kode' => 'A']);

        // Login sebagai user
        $this->actingAs($user);

        // Data yang dikirim user
        $response = $this->post('/antrian', [ // ganti ini sesuai route kamu
            'user_id' => $user->id,
            'antrian_id' => $antrian->id,
            'tanggal' => now()->toDateString(),
            'kode' => 'A-001', // ini akan diubah otomatis
            'nama_lengkap' => 'Budi Santoso',
            'nomor_hp' => '08123456789',
            'alamat' => 'Jl. Melati'
        ]);

        // Cek berhasil (redirect atau sukses)
        $response->assertStatus(302); // atau bisa juga 200, tergantung controller

        // Cek data benar-benar masuk DB
        $this->assertDatabaseHas('antrianstores', [
            'nama_lengkap' => 'Budi Santoso'
        ]);
    }
}
