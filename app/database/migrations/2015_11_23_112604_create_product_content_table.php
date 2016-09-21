<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_content', function($table)
		{
		    $table->increments('id');
		    $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages');
		    $table->string('title', 100);
		    $table->string('mini_description');
		    $table->longText('description');
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
		Schema::drop('product_content');
	}

}
