<?php

namespace Modules\Plan\Http\Requests\ConsumerCommitteeTransaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Plan\Enums\TransactionTypeEnum;

class StoreConsumerCommitteeTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(TransactionTypeEnum::class)],
            'date' => ['required'],
            'amount' => ['required', 'numeric','lte:'.($this->project->allocated_amount - $this->project->consumerCommitteeTransactions->sum('amount'))],
            'remarks' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'amount.lte' => 'प्रविष्ट गरिएको रकम बाँकी रकम भन्दा बढी हुन सक्दैन'
        ];
    }
}
