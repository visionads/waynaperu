<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('contents', function($table)
	    {
	        $table->increments('id');
	        $table->integer('page_id')->unsigned();
	        $table->foreign('page_id')->references('id')->on('pages');
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
		Schema::drop('contents');
	}

}
