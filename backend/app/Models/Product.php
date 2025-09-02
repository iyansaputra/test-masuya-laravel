<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'kode_produk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga',
        'stok'
    ];

    public function transactionsDetails()
    {
        return $this->hasMany(Transaction::class, 'kode_produk', 'kode_produk');
    }
}
