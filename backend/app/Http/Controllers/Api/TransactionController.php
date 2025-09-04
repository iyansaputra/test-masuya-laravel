<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\TransactionHeader;
use App\Services\InvoiceService;
use Exception;

class TransactionController extends Controller
{
    /**
     * @var InvoiceService
     */
    protected $invoiceService;

    /**
     * Constructor untuk meng-inject InvoiceService.
     *
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Menampilkan daftar semua transaksi.
     */
    public function index()
    {
        $transactions = TransactionHeader::with(['customer', 'details.product'])
            ->latest()
            ->get();

        return TransactionResource::collection($transactions);
    }

    /**
     * Menyimpan transaksi baru ke dalam storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        try {
            $transaction = $this->invoiceService->createTransaction($request->validated());

            return (new TransactionResource($transaction))
                    ->response()
                    ->setStatusCode(201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat transaksi.',
                'error' => $e->getMessage()
            ], 422); 
        }
    }

    /**
     * Menampilkan satu transaksi spesifik.
     */
    public function show(TransactionHeader $transaction)
    {
        $transaction->load(['customer', 'details.product']);

        return new TransactionResource($transaction);
    }

}