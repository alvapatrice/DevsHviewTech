<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleSlugColumnToThreadCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('thread_categories', function(Blueprint $table)
		{
			$table->string('title')->before('created_at');
            $table->string('slug')->before('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('thread_categories', function(Blueprint $table)
		{
			$table->dropColumn('slug');
            $table->dropColumn('title');
		});
	}

}
