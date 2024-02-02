<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BenefitedMemberDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['benefited_member_details'] ?? [];

        return [
            'वार्ड नं.' => $this->when(in_array('ward_no', $request_columns), $this->ward_no ?? ''),
            'गाउँ' => $this->when(in_array('village', $request_columns), $this->village ?? ''),
            'दलित पिछडिएको घरधुरी संख्या' => $this->when(in_array('dalit_backward_no', $request_columns), $this->dalit_backward_no ?? ''),
            'अन्य घरधुरी संख्या' => $this->when(in_array('other_households_no', $request_columns), $this->other_households_no ?? ''),
            'पुरुष संख्या' => $this->when(in_array('no_of_male', $request_columns), $this->no_of_male ?? ''),
            'महिला संख्या' => $this->when(in_array('no_of_female', $request_columns), $this->no_of_female ?? ''),
        ];
    }
}
