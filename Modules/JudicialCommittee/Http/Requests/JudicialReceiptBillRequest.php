<?php

namespace Modules\JudicialCommittee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JudicialReceiptBillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bill_no' => ['required'],
            'entry_person' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'bill_date' => ['required'],
            'file' => ['nullable', 'mimes:jpg,png,jpeg,pdf'],
        ];
    }

    public function messages(): array
    {
        return [
            'bill_no.required' => 'बिल नम्बर आवश्यक छ',
            'bill_no.unique' => 'बिल नम्बर पहिले नै लिइएको छ',
            'entry_person.required' => 'प्रवेश गर्ने व्यक्ति आवश्यक छ',
            'amount.required' => 'रकम आवश्यक छ',
            'bill_date.required' => 'बिल मिति आवश्यक छ',
        ];
    }
}
