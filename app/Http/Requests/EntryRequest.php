<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plate' => ['required'],
            'type' => ['required', 'min:1'],
            'entry_date' => ['required'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'hall_id' => ['required'],
            'stall_id' => ['required'],
            'image' => ['nullable', 'file']
        ];
    }

}
