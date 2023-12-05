<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create 5 users
        $users = User::factory(5)->create();

        // Iterate through each user and create 5 posts for each user
        $users->each(function ($user) {
            Post::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
