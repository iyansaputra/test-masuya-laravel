<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product' => new ProductResource($this->whenLoaded('product')),
            'qty' => $this->qty,
            'harga_satuan' => (float) $this->harga,
            'harga_net' => (float) $this->harga_net,
            'jumlah' => (float) $this->jumlah,
        ];
    }
}