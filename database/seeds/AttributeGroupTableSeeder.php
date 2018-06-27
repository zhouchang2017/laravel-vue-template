<?php

use Illuminate\Database\Seeder;
use App\Models\AttributeGroup;

class AttributeGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeGroup::create(
            [
                'name'     => '证书编号',
                'variant'  => false,
                'type'     => 'text',
                'required' => true,
            ]
        );

        AttributeGroup::create(
            [
                'name'     => '型号',
                'variant'  => false,
                'type'     => 'text',
                'required' => true,
            ]
        );

        AttributeGroup::create([
            'name'       => '运行内存RAM',
            'variant'    => false,
            'type'       => 'select',
            'required'   => true,
            'customized' => true,
        ])->values()->createMany([
            [ 'value' => '512MB' ],
            [ 'value' => '1G' ],
            [ 'value' => '2G' ],
            [ 'value' => '4G' ],
        ]);

        AttributeGroup::create([
            'name'       => '颜色',
            'variant'    => true,
            'type'       => 'checkbox',
            'required'   => false,
            'customized' => true,
        ])->values()->createMany([
            [ 'value' => '红色' ],
            [ 'value' => '白色' ],
            [ 'value' => '蓝色' ],
        ]);

        AttributeGroup::create([
            'name'       => '存储容量',
            'variant'    => true,
            'type'       => 'checkbox',
            'required'   => false,
            'customized' => true,
        ])->values()->createMany([
            [ 'value' => '8G' ],
            [ 'value' => '16G' ],
            [ 'value' => '32G' ],
            [ 'value' => '64G' ],
            [ 'value' => '128G' ],
            [ 'value' => '256G' ],
        ]);

        DB::table('product_type_attribute_group')->insert([
            ['type_id'=>1,'group_id'=>1],
            ['type_id'=>1,'group_id'=>2],
            ['type_id'=>1,'group_id'=>3],
            ['type_id'=>1,'group_id'=>4],
            ['type_id'=>1,'group_id'=>5],
        ]);
    }
}
