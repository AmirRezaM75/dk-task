<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'stock' => $this->faker->randomNumber()
        ];
    }
}
