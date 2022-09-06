<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'doctor_id' => [
                'required',
                'integer',
            ],
            'clinic_id' => [
                'required',
                'integer',
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'required',
                'array',
            ],
            'pulse_counter' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'used_pulse' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'device_pulse' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'array',
            ],
            'branch_id' => [
                'required',
                'integer',
            ],
            'comment' => [
                'string',
                'nullable',
            ],
        ];
    }
}
