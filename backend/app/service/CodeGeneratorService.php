<?php

namespace App\Services;

class CodeGeneratorService
{
    public static function validateProductCode(string $kode)
    {
        if (!preg_match('/^[A-Za-z0-9]+$/', $kode)) {
            throw new \InvalidArgumentException("Kode produk hanya boleh alphanumeric tanpa spasi atau karakter khusus.");
        }
        return strtoupper($kode);
    }

    public static function validateCustomerCode(string $kode)
    {
        if (!preg_match('/^[A-Za-z0-9]+$/', $kode)) {
            throw new \InvalidArgumentException("Kode customer hanya boleh alphanumeric tanpa spasi atau karakter khusus.");
        }
        return strtoupper($kode);
    }
}
