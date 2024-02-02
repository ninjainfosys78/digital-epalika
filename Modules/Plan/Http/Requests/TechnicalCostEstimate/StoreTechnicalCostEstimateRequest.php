<?php

namespace Modules\Plan\Http\Requests\TechnicalCostEstimate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTechnicalCostEstimateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('technicalCostEstimate_edit');
    }

    public function rules(): array
    {
        return [
            'detail' => ['required', 'string', 'max:255'],
            'number' => ['nullable', 'numeric'],
            'length' => ['nullable', 'numeric'],
            'breadth' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'unit' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'detail.required' => 'विवरण आवश्यक छ',
            'quantity.required' => 'परिमाण आवश्यक छ',
            'unit.required' => 'इकाई आवश्यक छ',
            'rate.required' => 'दर आवश्यक छ',
        ];
    }
}
