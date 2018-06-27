<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'type'       => $this->type,
            'variant'    => $this->variant,
            'required'   => $this->required,
            'customized' => $this->customized,
            'can_upload' => $this->can_upload,
        ];
    }
}
