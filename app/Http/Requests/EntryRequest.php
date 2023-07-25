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
            'type' => ['required'],
            'entry_date' => ['required'],
            'destination' => ['required'],
            'origin' => ['required'],
            'destination_type' => ['in:hall,stall'],
            'image' => ['nullable', 'file']
        ];
    }

}
