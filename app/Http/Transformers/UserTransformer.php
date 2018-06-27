<?php

namespace App\Http\Transformers;

use App\Models\User;

class UserTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(User $user)
    {
        $this->hidden && $user->addHidden($this->hidden);
        return $user->attributesToArray();
    }


}
