<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Antrian;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antrianstore extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'antrian_id',
        'tanggal',
        'kode',
        'nama_lengkap',
        'nomor_hp',
        'alamat',
        'kuota',
        'status',
        'waktu_ambil',
        'dipanggil_pada',
        'selesai_pada',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_ambil' => 'datetime',
        'dipanggil_pada' => 'datetime',
        'selesai_pada' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Antrian
    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }

    // Format waktu ambil
    public function waktuAmbilHuman()
    {
        return $this->waktu_ambil ? $this->waktu_ambil->diffForHumans() : '-';
    }

    // Format dipanggil
    public function dipanggilPadaHuman()
    {
        return $this->dipanggil_pada ? $this->dipanggil_pada->format('H:i') : '-';
    }

    // Format selesai
    public function selesaiPadaHuman()
    {
        return $this->selesai_pada ? $this->selesai_pada->format('H:i') : '-';
    }

    // Status dengan badge atau labe

}
