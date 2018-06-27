<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProviderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_provider_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable()->comment('电子邮箱');
            $table->string('qq')->nullable()->comment('qq');
            $table->string('wechat')->nullable()->comment('微信');
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
        Schema::dropIfExists('product_provider_infos');
    }
}
