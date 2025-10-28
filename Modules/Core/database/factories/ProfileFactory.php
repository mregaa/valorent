<?php

namespace Modules\Core\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\App\Entities\Profile;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'birth_date' => $this->faker->date,
            'avatar' => $this->faker->imageUrl(400, 400, 'people'),
        ];
    }
}