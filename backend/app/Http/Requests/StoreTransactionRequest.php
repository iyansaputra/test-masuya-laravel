<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'kode_customer'         => 'required|string|exists:customers,kode_customer',
            'tgl_inv'               => 'nullable|date',
            'items'                 => 'required|array|min:1',
            'items.*.kode_produk'   => 'required|string|exists:products,kode_produk',
            'items.*.qty'           => 'required|integer|min:1',
            // 'items.*.harga'         => 'nullable|numeric|min:0',
            'items.*.disc_1'        => 'nullable|numeric|min:0|max:100',
            'items.*.disc_2'        => 'nullable|numeric|min:0|max:100',
            'items.*.disc_3'        => 'nullable|numeric|min:0|max:100',
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->tgl_inv) {
            $this->merge([
                'tgl_inv' => now()->format('Y-m-d')
            ]);
        }
    }
}