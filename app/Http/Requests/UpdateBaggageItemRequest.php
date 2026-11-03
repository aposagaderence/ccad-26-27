<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBaggageItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('baggage_item');

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
                Rule::unique('baggage_items', 'bag_tag_number')->ignore($id),
            ],
            'bag_weight_kg' => [
                'required', 'numeric', 'gt:0', 'max:999999.99',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'bag_tag_number.unique' => 'This bag tag is already registered.',
            'bag_weight_kg.gt' => 'Bag weight must be greater than zero.',
        ];
    }
}