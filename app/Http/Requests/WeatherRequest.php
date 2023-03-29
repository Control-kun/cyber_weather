<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
