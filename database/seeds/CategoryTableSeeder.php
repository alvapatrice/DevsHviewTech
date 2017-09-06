<?php

use App\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach ( range(1,20) as $index )
        {
            $title = $faker->word() . $index;

            Category::create([
                'title' => $title,
                'slug' => str_replace(' ', '-', $title),
                'parent_id' => 0,
                'description' => 'No Description'
            ]);
        }
    }

}