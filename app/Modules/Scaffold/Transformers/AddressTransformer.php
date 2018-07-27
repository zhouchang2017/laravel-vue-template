<?php

namespace App\Modules\Scaffold\Transformers;

use App\Modules\Scaffold\Models\Address;
use App\Modules\Scaffold\Transformer;

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
