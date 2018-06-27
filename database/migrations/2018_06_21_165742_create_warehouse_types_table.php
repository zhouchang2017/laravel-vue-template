<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('仓库类型名称');
            $table->text('description')->nullable()->comment('简介');
            $table->boolean('enabled')->default(true)->comment('是否启用');
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
        Schema::dropIfExists('warehouse_types');
    }
}
