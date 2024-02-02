<?php

namespace Modules\Grant\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class GrantResourceReport extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['grant_details'] ?? [];
        return [
            'अनुदान' => $this->when(in_array('grant_id', $request_columns), $this->grant->title ?? ''),
            'व्यक्तिगत लगानी' => $this->when(in_array('personal_investment', $request_columns), $this->personal_investment ?? ''),
            'पुरानो आर्थिक वर्ष' => $this->when(in_array('prev_fiscal_year_id', $request_columns), $this->prevFiscalYear->title ?? ''),
            'लागनी रकम' => $this->when(in_array('investment_amount', $request_columns), $this->investment_amount ?? ''),
            'अनुदान आयोजना भएको पालिका' => $this->when(in_array('local_body_id', $request_columns), $this->localBody->local_body ?? ''),
            'अनुदान आयोजना भएको वार्ड' => $this->when(in_array('ward_no', $request_columns), $this->ward_no ?? ''),
            'अनुदान आयोजना भएको गाउ' => $this->when(in_array('village', $request_columns), $this->village ?? ''),
            'अनुदान आयोजना भएको टोल' => $this->when(in_array('tole', $request_columns), $this->tole ?? ''),
            'कित्ता नं' => $this->when(in_array('plot_no', $request_columns), $this->plot_no ?? ''),
            'सम्पर्क व्यक्ति' => $this->when(in_array('contact_person', $request_columns), $this->contact_person ?? ''),
            'सम्पर्क' => $this->when(in_array('contact', $request_columns), $this->contact ?? ''),
            'कैफियत' => $this->when(in_array('remarks', $request_columns), $this->remarks ?? ''),
        ];
    }
}
