<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use function implode;
use function json_encode;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => implode(' ', $this->faker->words(5)),
            'body' => json_encode(implode("</p><p>", $this->faker->paragraphs())),
            'userId' => User::factory()
        ];
    }
}
