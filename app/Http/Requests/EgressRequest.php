<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EgressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'plate' => ['required'],
            'type' => ['required', 'json'],
            'entry_date' => ['required'],
            'destination' => ['required'],
            'image' => ['nullable', 'file']
        ];
    }
}
