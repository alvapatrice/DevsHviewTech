<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdForienKeyToThreadsTablet extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('threads', function(Blueprint $table)
		{
            $table->foreign('category_id')->references('id')->on('thread_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('threads', function(Blueprint $table)
		{
            $table->dropForeign('threads_category_id_foreign');
        });
	}

}
