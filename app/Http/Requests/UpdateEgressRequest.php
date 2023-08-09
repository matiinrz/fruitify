<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plate' => ['nullable'],
            'plate_image' => ['nullable','file'],
            'entry_date' => ['required'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'hall_id' => ['required'],
            'stall_id' => ['required'],
            'image' => ['nullable', 'file']
        ];
    }
}
