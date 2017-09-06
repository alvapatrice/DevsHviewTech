<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach ( range(1,5) as $index )
        {
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            User::create([
                'name' => strtolower($first_name) . '_' . strtolower($last_name),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $faker->email(),
                'password' => Hash::make('12345'),
                'type' => $index%4
            ]);
        }
//        User::create([
//            'name' => 'Admin',
//            'first_name' => 'Admin',
//            'last_name' => 'Admin',
//            'email' => 'satishux@gmail.com',
//            'password' => Hash::make('admin'),
//            'type' => 0
//        ]);
    }

}