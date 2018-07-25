<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProviderTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('供应商名称');
            $table->string('code')->nullable()->comment('供应商代码')->unique();
            $table->unsignedTinyInteger('level')->default(0)->comment('供应商等级');
            $table->text('description')->nullable()->comment('供应商描述说明');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('product_provider_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable()->comment('电子邮箱');
            $table->string('qq')->nullable()->comment('qq');
            $table->string('wechat')->nullable()->comment('微信');
            $table->unsignedInteger('product_provider_id')->comment('供应商id');
            $table->timestamps();

            $table->foreign('product_provider_id')
                ->references('id')
                ->on('product_providers')
                ->onDelete('cascade');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('结算方式名称');
            $table->json('options')->nullable()->comment('结算方式配置');
            $table->timestamps();
        });

        Schema::create('product_provider_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('balance_id')->comment('结算方式');
            $table->text('description')->nullable()->comment('结算方式备注');
            $table->unsignedInteger('payment_id')->comment('支付方式');
            $table->json('options')->nullable()->comment('支付配置');
            $table->unsignedInteger('product_provider_id')->comment('供应商id');
            $table->timestamps();

            $table->foreign('product_provider_id')
                ->references('id')
                ->on('product_providers')
                ->onDelete('cascade');

            $table->foreign('balance_id')
                ->references('id')
                ->on('balances')
                ->onDelete('cascade');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onDelete('cascade');
        });

        Schema::create('variant_provider', function (Blueprint $table) {
            $table->unsignedInteger('product_variant_id');
            $table->unsignedInteger('product_provider_id');
            $table->unsignedInteger('price')->default(0)->comment('报价');
            $table->timestamps();

            $table->foreign('product_variant_id')
                ->references('id')
                ->on('product_variants')
                ->onDelete('cascade');

            $table->foreign('product_provider_id')
                ->references('id')
                ->on('product_providers')
                ->onDelete('cascade');

            $table->primary(['product_variant_id', 'product_provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('variant_provider');
        Schema::drop('product_provider_payments');
        Schema::drop('balances');
        Schema::drop('payments');
        Schema::drop('product_provider_info');
        Schema::drop('product_providers');
    }
}
