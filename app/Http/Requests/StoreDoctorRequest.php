<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'clinics.*' => [
                'integer',
            ],
            'clinics' => [
                'array',
            ],
            'percentage' => [
                'numeric',
                'required',
                'min:0',
                'max:100',
            ],
        ];
    }
}
