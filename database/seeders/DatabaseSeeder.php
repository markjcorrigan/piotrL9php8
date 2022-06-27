<?php

//namespace Database\Seeders;


use Database\Seeders\AdminSeeder;
use Database\Seeders\BlogPostTableSeeder;
use Database\Seeders\CommentsTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\TagsTableSeeder;
use Database\Seeders\BlogPostTagTableSeeder;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;



class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }

        Cache::tags(['blog-post'])->flush();

        $this->call([
            UserTableSeeder::class,
            BlogPostTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class,

        ]);
    }
}
