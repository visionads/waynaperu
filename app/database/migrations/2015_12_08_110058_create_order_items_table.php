<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function($table)

		{

		    $table->increments('id');
		    $table->integer("order_id")->unsigned();
		    $table->foreign('order_id')->references('id')->on('orders');
		    $table->integer("product_id")->unsigned();
		    $table->foreign('product_id')->references('id')->on('products');
		    $table->integer("loc_id")->unsigned()->nullable();
		    $table->foreign('loc_id')->references('id')->on('locations');
	        $table->integer('pdf_qty')->nullable();
	        $table->float('pdf_price')->nullable();
	        $table->integer('mail_qty')->nullable();
	        $table->float('mail_price')->nullable();
	        $table->integer('gift_qty')->nullable();
	        $table->float('gift_price')->nullable();
	        $table->text('details')->nullable();
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
		Schema::drop('order_items');
	}

}
