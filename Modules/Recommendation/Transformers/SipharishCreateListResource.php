<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SipharishCreateListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'SipharishFormType' => $this->SipharishFormType?->title ?? '',
            'approved_date' => $this->approved_date ?? '',
            'approved_status' => $this->approved_status ?? '',
            'status' => $this->status == 1 ? true : false,
            'file' => !empty($this->file) ? $this->file_url : null,
            'sipharishCreatedValues' => SipharishCreateValueResource::collection($this->whenLoaded('SipharishCreatedValues')) ?? '',
            'sipharisCreatedDocuments' => SipharishCreateDocumentResource::collection($this->whenLoaded('SipharisCreatedDocuments')) ?? ''
        ];
    }
}
