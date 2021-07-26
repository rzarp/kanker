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
            'dokter_id' => 'required',

            'name' => 'required',
            'medical_number_record' => 'required',
            'ktp' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'address' => 'required',

            'length_of_stay' => 'required',
            'stadium_type' => 'required',
            'tumor_size' => 'required',
            'treatment_type' => 'required',
            'status' => 'required',

            'icu_indikator' => 'nullable',
            'icu_los' => 'nullable',
            'vent_hour' => 'nullable'
        ];
    }

    public function validated()
    {
        $validated = parent::validated();

        $validated['icu_indikator'] = (bool) $validated['icu_indikator'];

        return $validated;
    }
}
