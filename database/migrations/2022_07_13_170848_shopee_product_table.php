<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShopeeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopee_product', function (Blueprint $table) {
            $table->bigInteger('itemid')->unique();
            $table->string('name');
            $table->string('local_name');
            $table->string('price');
            $table->string('stock');
            $table->string('rating_start');
            $table->integer('historical_sold');
            $table->string('shop_location');
            $table->text('images');
            $table->text('description');
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
        Schema::dropIfExists('shopee_product');
    }
}
