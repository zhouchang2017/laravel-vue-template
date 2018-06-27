<?php

use Illuminate\Database\Seeder;
use App\Models\ProductType;
class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'name'=>'手机'
            ],
            [
                'name'=>'洗衣机'
            ],
            [
                'name'=>'电视机'
            ]
        ]);
    }
}
