<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int)$this->command->ask('How many users would you like?', 20), 1);
        User::factory()->count($usersCount)->create();
        if ($this->command->confirm('Do you want to add yourself as the admin to the database?')) {
            User::factory()->markjc()->create();
            $this->command->info('Admin was added');

            //  Generate unique password for your admin
            //  >>>php artisan tinker
            //  >>> echo Hash::make('123456');
            //  >>> $2y$10$JHK.2MTc9ORMmmlqoF.gg.SwDLnevVSj1oreHParu5PvcPEDOWqe6

        }

    }


}
