<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class InvoiceService
{
    /**
     * Membuat seluruh proses transaksi dari validasi hingga simpan ke database.
     *
     * @param array $data Data yang sudah divalidasi dari StoreTransactionRequest
     * @return TransactionHeader
     * @throws Exception
     */
    public function createTransaction(array $data): TransactionHeader
    {
        return DB::transaction(function () use ($data) {

            foreach ($data['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['kode_produk']);

                if (!$product) {
                    throw new Exception("Produk dengan kode {$item['kode_produk']} tidak ditemukan.");
                }

                if ($product->stok < $item['qty']) {
                    throw new Exception("Stok untuk produk '{$product->nama_produk}' tidak mencukupi. Sisa stok: {$product->stok}.");
                }
            }

            $customer = Customer::find($data['kode_customer']);
            $total = 0;

            $transactionHeader = TransactionHeader::create([
                'no_inv'          => $this->generateInvoiceNumber(),
                'tgl_inv'         => $data['tgl_inv'],
                'kode_customer'   => $customer->kode_customer,
                'nama_customer'   => $customer->nama_customer, 
                'alamat_customer' => $customer->alamat_lengkap, 
                'total'           => $total,
            ]);
            foreach ($data['items'] as $item) {
                $product = Product::find($item['kode_produk']);

                $harga = $product->harga;

                $hargaSetelahDisc1 = $harga * (1 - ($item['disc_1'] ?? 0) / 100);
                $hargaSetelahDisc2 = $hargaSetelahDisc1 * (1 - ($item['disc_2'] ?? 0) / 100);
                $hargaNet = $hargaSetelahDisc2 * (1 - ($item['disc_3'] ?? 0) / 100);
                $jumlah = $hargaNet * $item['qty'];

                TransactionDetail::create([
                    'no_inv'        => $transactionHeader->no_inv,
                    'kode_produk'   => $product->kode_produk,
                    'nama_produk'   => $product->nama_produk,
                    'qty'           => $item['qty'],
                    'harga'         => $harga,
                    'disc_1'        => $item['disc_1'] ?? 0,
                    'disc_2'        => $item['disc_2'] ?? 0,
                    'disc_3'        => $item['disc_3'] ?? 0,
                    'harga_net'     => $hargaNet,
                    'jumlah'        => $jumlah,
                ]);

                $total += $jumlah;

                $product->decrement('stok', $item['qty']);
            }

            $transactionHeader->total = $total;
            $transactionHeader->save();

            return $transactionHeader;
        });
    }


    /**
     * Men-generate nomor invoice unik dengan format INV/YYMM/NNNN.
     * Nomor urut akan reset setiap bulan.
     *
     * @return string
     */
    public function generateInvoiceNumber(): string
    {
        $now = Carbon::now();
        $yearMonth = $now->format('ym'); 
        $prefix = "INV/{$yearMonth}";

        $lastTransaction = TransactionHeader::whereYear('tgl_inv', $now->year)
            ->whereMonth('tgl_inv', $now->month)
            ->orderBy('no_inv', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastNumber = intval(substr($lastTransaction->no_inv, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . '/' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}