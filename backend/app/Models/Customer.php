<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Tambahkan ini
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory; // 2. Tambahkan ini

    protected $table = 'customers';
    protected $primaryKey = 'kode_customer';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_customer',
        'nama_customer',
        'alamat_lengkap',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos'
    ];
    
    public function transactions()
    {
        return $this->hasMany(TransactionHeader::class, 'kode_customer', 'kode_customer');
    }

    public function getRouteKeyName()
    {
        return 'kode_customer';
    }
}