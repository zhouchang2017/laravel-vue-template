<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProviderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_provider_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('balance_id')->comment('结算方式');
            $table->text('description')->nullable()->comment('结算方式备注');
            $table->unsignedInteger('payment_id')->comment('支付方式');
            $table->json('options')->nullable()->comment('支付配置');
            $table->unsignedInteger('product_provider_id')->comment('供应商id');
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
        Schema::dropIfExists('product_provider_pay_ments');
    }
}
