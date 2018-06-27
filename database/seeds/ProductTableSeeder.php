<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'code'=>'27SPM1073',
            'name'=>'Huawei/华为P20全面屏徕卡双摄正品4G手机',
            'name_cn'=>'华为P20全面屏徕卡双摄正品4G手机',
            'product_type_id'=>1,
            'body'=>'华为P20采用了5.8英寸的全面屏设计，亮度高达770nits，比iPhoneX亮度高23%;华为P20  Pro搭载了6.1英寸的OLED全面屏，拥有1000000:1的对比度，105%的色域。采用全新的渐变色机身，根据华为官方的说法，其设计灵感来自于我们赖以生存的大自然，寓意着五彩缤纷的世界，这一新设计令整机增色太多，十分惊艳，并且华为P20系列共为大家提供四种配色让大家选择。'
        ]);
    }
}
