<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;



class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogCount = (int)$this->command->ask('How many blog posts would you like?', 50);
        $users = User::all();

        BlogPost::factory()->count($blogCount)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });

    }
}
