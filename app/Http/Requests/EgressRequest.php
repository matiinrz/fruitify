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
            'plate' => ['required'],
            'type' => ['present', 'array', 'min:1'],
            'type.*' => ['required'],
            'entry_date' => ['required'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'hall_id' => ['required'],
            'stall_id' => ['required'],
            'image' => ['nullable', 'file']
        ];
    }
}
