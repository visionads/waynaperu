<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location_content', function($table)
		{
		    $table->increments('id');
		    $table->integer('loc_id')->unsigned();
            $table->foreign('loc_id')->references('id')->on('locations');
            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages');
		    $table->string('name', 100);
		    $table->text('details');
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
		Schema::drop('location_content');
	}

}
