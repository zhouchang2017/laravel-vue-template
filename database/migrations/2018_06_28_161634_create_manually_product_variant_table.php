<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManuallyProductVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manually_product_variant', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manually_id');
            $table->unsignedInteger('product_variant_id');
            $table->integer('price')->unsigned()->default(0)->comment('采购单价');
            $table->integer('pcs')->unsigned()->default(0)->comment('采购数量');
            $table->integer('offer_price')->unsigned()->default(0)->comment('供应商当时报价');
            $table->unsignedInteger('product_provider_id')->nullable()->comment('供应商id');
            $table->unsignedInteger('user_id')->nullable()->comment('采购员id');
            $table->integer('good')->default(0)->comment('良品数量');
            $table->integer('bad')->default(0)->comment('不良品数量');
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
        Schema::dropIfExists('manually_product_variant');
    }
}
