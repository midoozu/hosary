<?php

namespace App\Http\Requests;

use App\Models\Clinic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClinicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('clinic_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'array',
            ],
        ];
    }
}
