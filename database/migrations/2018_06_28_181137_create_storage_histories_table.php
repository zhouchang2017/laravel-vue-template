<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('warehouse_id')->comment('仓库id');
            $table->morphs('origin');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->unsignedInteger('product_variant_id')->comment('变体id');
            $table->integer('good')->default(0)->comment('入库良品数量');
            $table->integer('bad')->default(0)->comment('入库不良品数量');
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
        Schema::dropIfExists('storage_histories');
    }
}
