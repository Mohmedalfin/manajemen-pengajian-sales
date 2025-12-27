<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Kita set true dulu, logic admin-nya kita taruh di Controller biar eksplisit.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_lengkap'         => 'required|string|max:100',
            'kontak'               => 'required|string|max:50',
            'jabatan'              => 'required|string|max:50',
            'gaji_pokok'           => 'required|numeric|min:0',
            'target_penjualan_bln' => 'required|numeric|min:0',
            'status_aktif'         => 'required|boolean',
        ];
    }
}