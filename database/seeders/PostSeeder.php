<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    protected mixed $faker;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function run(): void
    {
        Post::factory([
            'userId' => User::first()->id
        ])
            ->count(25)
            ->create();
    }
}
