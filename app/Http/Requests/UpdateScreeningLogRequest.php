<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateScreeningLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'baggage_item_id' => [
                'required', 'integer', 'exists:baggage_items,id',
            ],
            'screening_gate_id' => [
                'required', 'integer', 'exists:screening_gates,id',
            ],
            'screener_officer' => [
                'required', 'string', 'max:150',
            ],
            'screening_result' => [
                'required', Rule::in(['Passed', 'Failed']),
            ],
            'flagged_reason' => [
                'nullable', 'required_if:screening_result,Failed',
                'string', 'max:2000',
            ],
            'clearance_status' => [
                'sometimes', Rule::in(['Pending', 'Cleared', 'Held']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'flagged_reason.required_if' => 'A flagged reason is required when screening fails.',
            'screening_result.in' => 'Screening result must be Passed or Failed.',
        ];
    }
}