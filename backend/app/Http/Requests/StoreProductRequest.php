<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode_produk' => 'required|string|alpha_num|max:50|unique:products,kode_produk',
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ];
    }

    /**
     * Mempersiapkan data untuk divalidasi.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->kode_produk) {
            $this->merge([
                'kode_produk' => strtoupper($this->kode_produk),
            ]);
        }
    }
}