<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_transaksi',
        'id_koleksi',
        'tanggal_kembali',
        'status',
        'keterangan'
    ];
}
