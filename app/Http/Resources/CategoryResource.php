<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    protected $availableIncludes = [ 'product_count' ];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->parseInclude();
        $response = $this->attributesToArray();
        return array_merge($response,
            [
                'children' => [ 'data' => $this::collection($this->whenLoaded('children')) ],
            ]);
    }

    private function parseInclude()
    {
        $include = explode(',', request()->input('include'));
        collect($include)->each(function($item){
            if(in_array($item,$this->availableIncludes)){
                $this->append(camel_case($item));
            }
        });
    }
}
