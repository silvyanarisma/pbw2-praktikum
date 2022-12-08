<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_petugas',
        'id_peminjam',
        'tanggal_pinjam',
        'tanggal_selesai'
    ];
}
