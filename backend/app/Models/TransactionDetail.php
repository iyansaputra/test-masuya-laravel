<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\TransactionHeader;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';

    protected $fillable = [
        'no_inv',
        'kode_produk',
        'nama_produk',
        'qty',
        'harga',
        'disc_1',
        'disc_2',
        'disc_3',
        'harga_net',
        'jumlah',
    ];

    public function transactionHeader()
    {
        return $this->belongsTo(TransactionHeader::class, 'no_inv', 'no_inv');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'kode_produk', 'kode_produk');
    }
}
