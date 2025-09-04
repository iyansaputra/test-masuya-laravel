<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'kode_customer' => 'required|string|alpha_num|max:50|unique:customers,kode_customer',
            'nama_customer' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string|max:255',
            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'kode_pos' => 'required|numeric|min:0'
        ];
    }

    /**
     * Mempersiapkan data untuk divalidasi.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->kode_customer) {
            $this->merge([
                'kode_customer' => strtoupper($this->kode_customer),
            ]);
        }
    }
}
