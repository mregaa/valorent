<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\App\Entities\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentence,
        ];
    }
}