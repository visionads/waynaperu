<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faqs', function($table)
		{
		    $table->increments('id');
		    $table->integer('product_id')->nullable()->unsigned();
	        $table->foreign('product_id')->references('id')->on('products');
	        $table->string('state');
	        $table->timestamps();
		});

		 Schema::create('faqcontents', function($table)
	    {
	        $table->increments('id');
	        
	        $table->integer('faq_id')->unsigned();
	        $table->foreign('faq_id')->references('id')->on('faqs');
	        $table->integer('lang_id')->unsigned();
	        $table->foreign('lang_id')->references('id')->on('languages');
	        $table->string('que');
	        $table->string('ans');

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
		Schema::drop('faqs');
		Schema::drop('faqcontents');
	}

}
