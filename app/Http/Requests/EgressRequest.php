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
            'plate' => ['required','regex:\d{2}[\u0600-\u06FF]\d{3}'],
            'type' => ['required'],
            'entry_date' => ['required'],
            'destination' => ['required'],
            'image' => ['nullable', 'file']
        ];
    }
}
