<?php

namespace App\Services;

use App\Models\TransactionHeader;
use Carbon\Carbon;

class InvoiceService
{
    public static function generateInvoiceNumber()
    {
        $dateCode = Carbon::now()->format('ym'); // contoh: 2507

        $lastInvoice = TransactionHeader::whereRaw("DATE_FORMAT(tgl_inv, '%y%m') = ?", [$dateCode])
            ->orderBy('no_inv', 'desc')
            ->value('no_inv');

        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "INV/{$dateCode}/{$newNumber}";
    }
}
