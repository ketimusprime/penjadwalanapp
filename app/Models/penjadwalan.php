<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penjadwalan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanggal',
        'waktu',
        'no_order',
        'order_type',
        'nama_pelanggan',
        'no_hp',
        'kategori_id',
        'subkategori_id',
        'produk_id',
        'nama_paket',
        'keterangan',
        'status',
        'users_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    public function subkategori()
    {
        return $this->belongsTo(subkategori::class, 'subkategori_id');
    }

    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
