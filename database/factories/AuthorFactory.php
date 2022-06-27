<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            //
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function($author) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
