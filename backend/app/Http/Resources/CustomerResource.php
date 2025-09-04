<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'kode_customer' => $this->kode_customer,
            'nama_customer' => $this->nama_customer,
            'alamat_lengkap' => $this->alamat_lengkap,
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'kode_pos' => $this->kode_pos,
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
