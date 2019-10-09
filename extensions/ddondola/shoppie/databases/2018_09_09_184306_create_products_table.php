<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('brand_id')->nullable();
            $table->unsignedInteger('subcategory_id');
            $table->string('name');
            $table->string('price');
            $table->text('description')->nullable();
            $table->text('settings')->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('products');
    }
}
