<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;
    protected $guard = ['id'];

    protected $fillable = [
        'nama_layanan',
        'kode',
        'deskripsi',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antrians()
    {
        return $this->belongsTo(Antrian::class);
    }
}
