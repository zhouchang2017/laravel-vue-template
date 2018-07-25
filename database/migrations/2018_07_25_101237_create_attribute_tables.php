<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->json('config')->nullable(); // {icon:'',avatar:''}
            $table->timestamps();
        });

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('属性名称');
            $table->boolean('variant')->default(false)->comment('是否为销售属性');
            $table->enum(
                'type',
                ['text', 'textarea', 'select', 'radio', 'richtext', 'checkbox', 'date', 'time', 'checkbox_group', 'radio_group', 'toggle']
            )->default('text');

            $table->boolean('required')->default(false)->comment('是否必填');
            $table->boolean('customized')->default(false)->comment('是否能自定义');
            $table->boolean('can_upload')->default(false);
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id');
            $table->string('value')->comment('属性值');
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on('attribute_groups')
                ->onDelete('cascade');
        });

        Schema::create('product_type_attribute_group', function (Blueprint $table) {
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('group_id');

            $table->foreign('group_id')
                ->references('id')
                ->on('attribute_groups')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('product_types')
                ->onDelete('cascade');
            $table->primary(['type_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_type_attribute_group');
        Schema::drop('attributes');
        Schema::drop('product_types');
        Schema::drop('attribute_groups');
    }
}
