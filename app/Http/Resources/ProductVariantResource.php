<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
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
        return array_merge($response, [
            'attributes' => [ 'data' => ProductAttributeResource::collection($this->whenLoaded('attributes')) ],
        ]);
    }
}
