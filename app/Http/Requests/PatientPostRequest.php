<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'dokter_id' => 'required',
            'medical_number_record' => 'required',
            'ktp' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'date_in' => 'required',
            'date_out' => 'required',
            'symptoms' => 'required',
            'disease' => 'required',
            'stadium' => 'required',
        ];
    }
}
