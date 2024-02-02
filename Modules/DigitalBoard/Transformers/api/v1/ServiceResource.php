<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'service_name' => $this->service_name ?? '',
            'time_taken' => $this->time_taken ?? '',
            'responsible_officer' => $this->responsible_officer ?? '',
            'office' => $this->office ?? '',
            'remarks' => $this->remarks ?? '',
            'branch_id' => $this->branch_id ?? '',
            'documents' => ServiceDocumentResource::collection($this->whenLoaded('serviceDocuments')),
            'process' => ServiceDocumentResource::collection($this->whenLoaded('serviceProcesses')),
            'employee' => ServiceEmployeeResource::collection($this->whenLoaded('serviceEmployees')),
        ];
    }
}
