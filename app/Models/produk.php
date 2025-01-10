<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subkategori_id',
        'name',
    ];

    public function subkategori()
    {
        return $this->belongsTo(subkategori::class);
    }
}
