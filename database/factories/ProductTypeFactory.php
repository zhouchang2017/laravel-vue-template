<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductType::class, function (Faker $faker) {
    $fakerData = [
        [
            'name'=>'手机'
        ],
        [
            'name'=>'洗衣机'
        ],
        [
            'name'=>'电视机'
        ]
    ];
    return $fakerData;
});
