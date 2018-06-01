<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('产品名称,生成listing的名称');
            $table->string('name_cn')->comment('中文配货名称');
            $table->string('name_en')->comment('英文配货名称');
            $table->boolean('enabled')->comment('可销售的');
            $table->unsignedInteger('product_type_id');
            $table->text('body')->nullable()->comment('产品描述');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
