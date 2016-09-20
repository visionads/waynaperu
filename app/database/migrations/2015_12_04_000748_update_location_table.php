<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locations', function($table)
		{
		    
            $table->integer('district_id')->unsigned()->after('price3');
            $table->foreign('district_id')->references('id')->on('districts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locations', function($table)
		{
		    $table->dropColumn('district_id');
		});
	}

}
