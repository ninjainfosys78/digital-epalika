<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectGrantDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['project_grant_details'] ?? [];

        return [
            'उपलब्ध गराउने स्रोत/निकाय' => $this->when(in_array('grant_source', $request_columns), $this->grant_source ?? ''),
            'सामाग्रीको नाम' => $this->when(in_array('asset_name', $request_columns), $this->asset_name ?? ''),
            'परिमाण' => $this->when(in_array('quantity', $request_columns), $this->quantity ?? 0),
            'एकाइ' => $this->when(in_array('asset_unit', $request_columns), $this->asset_unit ?? 0),
        ];
    }
}
