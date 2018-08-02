<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->comment('文件路径');
            $table->string('url')->comment('访问路径');
            $table->unsignedInteger('height')->nullable()->comment('高度');
            $table->unsignedInteger('width')->nullable()->comment('宽度');
            $table->string('size')->nullable()->comment('图片尺寸');
            $table->string('type')->nullable()->comment('资源类型');
            $table->morphs('assetable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
