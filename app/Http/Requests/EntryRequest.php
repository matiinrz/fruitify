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
            'type' => ['required', 'json'],
            'entry_date' => ['required'],
            'image' => ['nullable', 'file']
        ];
    }
}
