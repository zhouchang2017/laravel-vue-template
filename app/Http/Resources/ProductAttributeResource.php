<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = $this->attributesToArray();
        return array_merge($response,
            [
                'group' => [ 'data' => new AttributeGroupResource($this->whenLoaded('group')) ],
                'value' => [ 'data' => $this->getValue() ],
            ]);
    }

    private function getValue()
    {
        $value = new AttributeResource($this->whenLoaded('attributeValue'));
        if (is_null($value->resource)) {
            return [ 'value' => $this->comment ];
        }
        return $value;
    }
}
