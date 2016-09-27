<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('caption')->nullable();
            $table->text('url')->nullable();
            $table->text('path')->nullable();
            $table->enum('status',['active','inactive'])->nullable();
            $table->unsignedInteger('sequence')->nullable();
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
		Schema::drop('slider');
	}

}
