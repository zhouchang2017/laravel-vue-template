<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_groups');
    }
}
