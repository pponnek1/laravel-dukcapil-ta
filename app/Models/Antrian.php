<?php

namespace App\Models;

use App\Models\User;
use App\Models\AntrianStore;
use App\Models\Layanan;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'layanan_id',
        'nama_layanan',
        'kode',
        'deskripsi',
        'persyaratan',
        'kuota',
        'slug',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antrianStore()
    {
        return $this->hasMany(AntrianStore::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class); // Relasi dengan Layanan
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'layanan.nama_layanan', // Gunakan nama_layanan dari model layanan
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug'; // Menggunakan slug sebagai key
    }
}

