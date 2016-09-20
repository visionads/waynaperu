<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function($table)
		{
		    $table->increments('id');
		    $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
		    $table->integer('price1');
		    $table->integer('price2');
		    $table->integer('price3');
		    $table->integer('order');
		    $table->integer('product_image_id')->nullable();
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
		Schema::drop('locations');
	}

}
