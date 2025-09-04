<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nomor_invoice' => $this->no_inv,
            'tanggal' => $this->tgl_inv,
            'total' => (float) $this->total,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'items' => TransactionDetailResource::collection($this->whenLoaded('details')),
        ];
    }
}