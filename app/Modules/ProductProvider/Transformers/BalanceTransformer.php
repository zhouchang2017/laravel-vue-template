<?php

namespace App\Modules\ProductProvider\Transformers;

use App\Modules\ProductProvider\Models\Balance;
use App\Modules\Scaffold\Transformer;

class BalanceTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Balance $balance)
    {
        $this->hidden && $balance->addHidden($this->hidden);
        return $balance->attributesToArray();
    }


}
