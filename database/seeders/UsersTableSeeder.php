<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'phone' => '0123456789',
            'password' => '123456',
            'img' => 'user_images/'.time().'_'.rand(1,10000).'.jpg',
        ]);
        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'phone' => '0123456789',
            'password' => '123456',
            'img' => 'user_images/'.time().'_'.rand(1,10000).'.jpg',
        ]);
        User::create([
            'name' => 'User 3',
            'email' => 'user3@gmail.com',
            'phone' => '0123456789',
            'password' => '123456',
            'img' => 'user_images/'.time().'_'.rand(1,10000).'.jpg',
        ]);
    }
}
