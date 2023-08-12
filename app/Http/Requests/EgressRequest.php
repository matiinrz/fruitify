<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EgressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plate' => ['nullable'],
            'plate_image' => ['nullable', 'file'],
            'type' => ['required'],
            'type.*' => ['required'],
            'entry_date' => ['required'],
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'hall_id' => ['required', 'exists:halls,id'],
            'stall_id' => ['required', 'exists:stalls,id'],
            'image' => ['nullable', 'file']
        ];
    }
}
