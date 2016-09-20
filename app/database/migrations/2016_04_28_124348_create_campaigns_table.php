<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaigns', function($table)
		{
		    $table->increments('id');
		    $table->string('email')->unique();
		    $table->string('names', 65);
		    $table->string('surname_father', 45);
		    $table->string('surname_mother', 45);
		    $table->string('dni', 10);
		    $table->string('source', 45)->default('web');
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
		Schema::drop('campaigns');
	}

}
