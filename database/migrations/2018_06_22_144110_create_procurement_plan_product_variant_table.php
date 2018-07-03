<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementPlanProductVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_plan_product_variant', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('procurement_plan_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_variant_id');
            $table->integer('price')->unsigned()->default(0)->comment('采购单价');
            $table->integer('pcs')->unsigned()->default(0)->comment('采购数量');
            $table->integer('arrived_pcs')->unsigned()->default(0)->comment('以收到数量');
            $table->integer('offer_price')->unsigned()->default(0)->comment('供应商当时报价');
            $table->unsignedInteger('product_provider_id')->nullable()->comment('供应商id');
            $table->unsignedInteger('user_id')->nullable()->comment('采购员id');
            $table->integer('good')->default(0)->comment('良品数量');
            $table->integer('bad')->default(0)->comment('不良品数量');
            $table->integer('lost')->default(0)->comment('丢失数量');
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
        Schema::dropIfExists('procurement_plan_product_variant');
    }
}
