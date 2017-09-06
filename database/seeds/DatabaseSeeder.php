<?php

use App\Category;
use App\Post;
use App\User;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//        User::truncate();
//        Post::truncate();
//		Category::truncate();


        Model::unguard();

        $this->call('UserTableSeeder');
//		$this->call('CategoryTableSeeder');
		//$this->call('ArticleTableSeeder');
		//$this->call('TagsTableSeeder');

	}

}
