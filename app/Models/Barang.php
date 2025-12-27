<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'produk';
    
    protected $fillable = [
        'nama_produk',
        'harga_jual_unit',
        'stok',
    ];

    protected $casts = [
        'harga_jual_unit' => 'decimal:2',
        'stok' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($produk) {
            if (empty($produk->kode_produk)) {
                $produk->kode_produk = 'PRD-' . strtoupper(Str::random(8));
            }
        });
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'produk_id', 'id');
    }
}
