<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleBodyUserColumnsToThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('threads', function(Blueprint $table)
		{
            $table->integer('user_id')->unsigned()->after('id');
            $table->integer('category_id')->unsigned()->after('id');
            $table->string('body')->after('id');
			$table->string('title')->after('id');

            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropForeign('threads_user_id_foreign');
			$table->dropColumn('user_id');
            $table->dropColumn('body');
            $table->dropColumn('title');
            $table->dropColumn('category_id');
		});
	}

}
