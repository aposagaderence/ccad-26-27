<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaggageItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'passenger_id' => [
                'required', 'integer', 'exists:passengers,id',
            ],
            'flight_id' => [
                'required', 'integer', 'exists:flights,id',
            ],
            'bag_tag_number' => [
                'required', 'string', 'max:50',
                'regex:/^[A-Za-z0-9-]+$/',
                'unique:baggage_items,bag_tag_number',
            ],
            'bag_weight_kg' => [
                'required', 'numeric', 'gt:0', 'max:999999.99',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'passenger_id.exists' => 'The selected passenger does not exist.',
            'flight_id.exists' => 'The selected flight does not exist.',
            'bag_tag_number.unique' => 'This bag tag is already registered.',
            'bag_tag_number.regex' => 'The bag tag may contain only letters, numbers, and hyphens.',
            'bag_weight_kg.gt' => 'Bag weight must be greater than zero.',
        ];
    }
}