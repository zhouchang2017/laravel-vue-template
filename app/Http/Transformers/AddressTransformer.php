<?php

namespace App\Http\Transformers;

use App\Models\Address;

class AddressTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Address $address)
    {
        $this->hidden && $address->addHidden($this->hidden);
        return $address->attributesToArray();
    }


}
