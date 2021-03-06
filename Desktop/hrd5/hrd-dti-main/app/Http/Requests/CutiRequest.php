<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CutiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pegawai_id'    => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai'   => 'required|date',
            'keterangan'    => 'required|string'
        ];
    }
}
