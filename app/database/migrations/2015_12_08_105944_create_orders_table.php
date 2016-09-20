<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($table)

		{

		    $table->increments('id');
		    $table->string('order_number')->unique();
		    $table->integer("user_id")->nullable()->unsigned();
		    #$table->foreign('user_id')->references('id')->on('users');
	        $table->string('status');
	        $table->integer("qty");
	        $table->float('price');
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
		Schema::drop('orders');
	}

}
