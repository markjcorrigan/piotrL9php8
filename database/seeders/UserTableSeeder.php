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

        }

    }

    public function markjc()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'MarkJC',
                'email' => 'markjc@mweb.co.za',
                'email_verified_at' => now(),
                'password' => '$2y$10$bq11QPOak8z48jcJi0C.o.F2Eqlah2igJsbMGBKmP45WgUljMCG4y', // my fav password
                'remember_token' => Str::random(10),
                'is_admin' => true
            ];

        });

    }
}
