<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    protected $table = 'transaction_headers';
    protected $primaryKey = 'no_inv';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_inv',
        'tgl_inv',
        'kode_customer',
        'nama_customer',
        'alamat_customer',
        'total'
    ];

       public function customer()
    {
        return $this->belongsTo(Customer::class, 'kode_customer', 'kode_customer');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'no_inv', 'no_inv');
    }
}
