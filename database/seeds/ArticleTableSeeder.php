<?php

use App\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArticleTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach ( range(1,20) as $index )
        {
            $title = $faker->sentence(5);
            $subtitle = $faker->sentence(5);
            $description = $faker->sentence(20);
            $image = $faker->image($dir = 'public/images/articles', $width = 320, $height = 240, 'technics');
            $image = str_replace('public/images/articles\\', 'images/articles/', $image);

            Post::create([
                'title' => $title,
                'category_id' => 1,
                'subtitle' => $subtitle,
                'description' => $description,
                'slug' => str_replace(' ', '_', $title),
                //'image' => 'images/articles/some_image.png',
                'image' => $image,
                'body' => $faker->paragraph(4)
            ]);
        }
    }

}