<?php

use App\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TagsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach ( range(1,20) as $index )
        {
            $title = $faker->sentence(5);

            Tag::create([
                'title' => $title,
                'slug' => str_replace(' ', '-', $title),
                'description' => 'No Description'
            ]);
        }
    }

}