<?php

namespace Modules\DigitalBoard\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'service_name' => ['required'],
            'time_taken' => ['required'],
            'responsible_officer' => ['required'],
            'office' => ['required'],
            'remarks' => ['nullable'],
            'serviceDocuments' => ['required', 'array'],
            'serviceDocuments.*.description' => ['required'],
            'serviceProcesses' => ['required', 'array'],
            'serviceProcesses.*.description' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'service_name.required' => 'सेवाको नाम आवश्यक छ',
            'time_taken.required' => 'लाग्ने समय आबश्यक छ ',
            'responsible_officer.required' => 'जिम्मेवार कर्मचारी आबश्यक छ ',
            'office.required' => 'कोठा नम्बर/कार्यालय आबश्यक छ ',
            'serviceDocuments.required' => 'आबश्यक कागजात अनिबार्य छ ',
            'serviceDocuments.*.description.required' => 'कागजात आबश्यक छ ',
            'serviceProcesses.required' => 'उपलब्ध गराउने प्रक्रिया अनिबार्य छ ',
            'serviceProcesses.*.description.required' => 'उपलब्ध गराउने प्रक्रिया आबश्यक छ ',
        ];
    }
}
