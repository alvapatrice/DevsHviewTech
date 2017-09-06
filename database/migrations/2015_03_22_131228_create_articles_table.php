<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('slug', 100);
            $table->string('image', 200);
            $table->text('body');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
