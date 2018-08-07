<?php

use Faker\Generator as Faker;
use App\Modules\Product\Models\Category;
$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'children'=>[
            [
                'name'=>$faker->name,
                'children'=>[
                    ['name'=>$faker->name]
                ]
            ]
        ]
    ];
});
