<?php

namespace App\Models;


class ProductVariantInfo extends Model
{
    protected $table = 'product_variant_info';

    protected $fillable = [
        'product_variant_id',
        'length_value',
        'length_unit',
        'height_value',
        'height_unit',
        'width_value',
        'width_unit',
        'weight_value',
        'weight_unit',
        'package_length_value',
        'package_length_unit',
        'package_height_value',
        'package_height_unit',
        'package_width_value',
        'package_width_unit',
        'package_weight_value',
        'package_weight_unit',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}
