<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        # return parent::toArray($request);
        return [
            'id'             => $this->id,
            'attachment_name'=> $this->attachment_name,
            'attachment_url' => asset('store/attachment/'.$this->attachment_url),
        ];
    }
}
