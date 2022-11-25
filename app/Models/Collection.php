<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_koleksi',
        'jenis_koleksi',
        'jumlah_awal',
        'jumlah_sisa',
        'jumlah_keluar',
        'created_at'
    ];
}
