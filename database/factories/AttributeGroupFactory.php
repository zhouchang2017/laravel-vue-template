<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AttributeGroup::class, function (Faker $faker) {
    return [
        [
            'name'=>'证书编号',
            'variant'=>false,
            'type'=>'text',
            'required'=>true
        ],
        [
            'name'=>'型号',
            'variant'=>false,
            'type'=>'text',
            'required'=>true
        ],
        [
            'name'=>'运行内存RAM',
            'variant'=>false,
            'type'=>'select',
            'required'=>true
        ],
        [
            'name'=>'颜色',
            'variant'=>true,
            'type'=>'checkbox',
            'required'=>false
        ],
        [
            'name'=>'存储容量',
            'variant'=>true,
            'type'=>'checkbox',
            'required'=>false
        ]
    ];
});
