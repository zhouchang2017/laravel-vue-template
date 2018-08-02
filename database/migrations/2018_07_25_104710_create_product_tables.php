<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands',function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('品牌名称');
            $table->string('description')->nullable()->comment('品牌描述');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('货号')->default(null);
            $table->string('name')->comment('产品名称,生成listing的名称');
            $table->string('name_cn')->comment('中文配货名称');
            $table->string('name_en')->nullable()->comment('英文配货名称');
//            $table->bigIncrements('price')->default(0)->comment('参考价');
            $table->boolean('enabled')->default(true)->comment('可销售的');
            $table->unsignedInteger('type_id')->comment('产品类型');
            $table->text('body')->nullable()->comment('产品描述');
            $table->unsignedInteger('brand_id')->nullable()->comment('品牌id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('product_types')
                ->onDelete('cascade');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('attribute_group_id');
            $table->unsignedInteger('attribute_id')->nullable();
            $table->string('comment')->nullable()->comment('备注属性值');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('attribute_group_id')
                ->references('id')
                ->on('attribute_groups')
                ->onDelete('cascade');

            $table->foreign('attribute_id')
                ->references('id')
                ->on('attributes')
                ->onDelete('cascade');
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->string('sku')->unique();
            $table->json('options')->nullable();
            $table->unsignedInteger('price')->default(0);
//            $table->integer('stock')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });

        Schema::create('product_variant_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_variant_id')->nullable();
            // Weights and stuff
            $table->decimal('length_value', 10, 5)->default(0.00)->unsigned();
            $table->string('length_unit')->default('MM');

            $table->decimal('height_value', 10, 5)->default(0.00)->unsigned();
            $table->string('height_unit')->default('MM');

            $table->decimal('width_value', 10, 5)->default(0.00)->unsigned();
            $table->string('width_unit')->default('MM');

            $table->decimal('weight_value', 10, 5)->default(0.00)->unsigned();
            $table->string('weight_unit')->default('GR');

            // Package
            $table->decimal('package_length_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_length_unit')->default('MM');

            $table->decimal('package_height_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_height_unit')->default('MM');

            $table->decimal('package_width_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_width_unit')->default('MM');

            $table->decimal('package_weight_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_weight_unit')->default('GR');
            $table->timestamps();

            $table->foreign('product_variant_id')
                ->references('id')
                ->on('product_variants')
                ->onDelete('cascade');
        });

        Schema::create('product_variant_product_attribute', function (Blueprint $table) {
            $table->unsignedInteger('product_variant_id');
            $table->unsignedInteger('product_attribute_id');

            $table->foreign('product_variant_id','variant_attribute_variant_id')
                ->references('id')
                ->on('product_variants')
                ->onDelete('cascade');

            $table->foreign('product_attribute_id','variant_attribute_product_attribute_id')
                ->references('id')
                ->on('product_attributes')
                ->onDelete('cascade');

            $table->primary(['product_variant_id', 'product_attribute_id'],'variant_attribute');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_variant_product_attribute');
        Schema::drop('product_variant_info');
        Schema::drop('product_variants');
        Schema::drop('product_attributes');
        Schema::drop('products');
        Schema::drop('brands');
    }
}
