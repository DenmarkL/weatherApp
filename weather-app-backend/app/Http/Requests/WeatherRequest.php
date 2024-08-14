<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];
    }

    protected function passedValidation()
    {
        // Set default values for Tokyo if latitude or longitude is null
        $this->merge([
            'latitude' => $this->input('latitude', 35.682839), // Tokyo's latitude
            'longitude' => $this->input('longitude', 139.759455), // Tokyo's longitude
        ]);
    }
}
