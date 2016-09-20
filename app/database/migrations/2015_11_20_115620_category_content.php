<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryContent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('category_content', function($table)
	    {
	        $table->increments('id');
	        $table->integer('cat_id')->unsigned();
	        $table->foreign('cat_id')->references('id')->on('categories');
	        $table->integer('lang_id')->unsigned();
	        $table->foreign('lang_id')->references('id')->on('languages');
	        $table->string('title');
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
		Schema::drop('category_content');
	}

}
