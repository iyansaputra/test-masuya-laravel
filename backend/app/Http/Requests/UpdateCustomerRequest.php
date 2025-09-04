<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'nama_customer'  => 'nullable|string|max:100',
            'alamat_lengkap' => 'nullable|string|max:255',
            'provinsi'       => 'nullable|string|max:100',
            'kota'           => 'nullable|string|max:100',
            'kecamatan'      => 'nullable|string|max:100',
            'kelurahan'      => 'nullable|string|max:100',
            'kode_pos'       => 'nullable|numeric|min:0'
        ];
    }
}
