<?php

namespace Modules\BusinessRegistration\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessRenewResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['business_renews'] ?? [];
        return [
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'नबिकरण मिति वि.सं.' => $this->when(in_array('business_renew_date', $request_columns), $this->business_renew_date ?? ''),
            'नबिकरण मिति ई.सं.' => $this->when(in_array('business_renew_date_en', $request_columns), $this->business_renew_date_en ?? ''),
            'नबिकरण कायम रहने मिति वि.सं.' => $this->when(in_array('date_to_be_maintained', $request_columns), $this->date_to_be_maintained ?? ''),
            'नबिकरण कायम रहने मिति ई.सं.' => $this->when(in_array('date_to_be_maintained_en', $request_columns), $this->date_to_be_maintained_en ?? ''),
            'नबिकरण रकम' => $this->when(in_array('renew_amount', $request_columns), $this->renew_amount ?? ''),
            'जरिवाना रकम' => $this->when(in_array('penalty_amount', $request_columns), $this->penalty_amount ?? ''),
            'बिल नं.' => $this->when(in_array('payment_receipt', $request_columns), $this->payment_receipt ?? ''),
            'रसिद मिति वि.सं.' => $this->when(in_array('payment_receipt_date', $request_columns), $this->payment_receipt_date ?? ''),
            'रसिद मिति ई.सं.' => $this->when(in_array('payment_receipt_date_en', $request_columns), $this->payment_receipt_date_en ?? ''),
        ];
    }
}
