<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenRequest extends FormRequest
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
            'tanggal'   => 'required|date',
            'jam_masuk' => 'required|string',
            'jam_keluar'    => 'required|string',
            'keterangan'    => 'required|string'
        ];
    }
}
