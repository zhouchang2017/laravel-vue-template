<?php

namespace App\Http\Transformers;

use App\Models\Balance;

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