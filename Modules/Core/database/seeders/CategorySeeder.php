<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\App\Entities\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sultan',
                'slug' => 'sultan',
                'description' => 'Akun dengan skin lengkap dan premium',
            ],
            [
                'name' => 'Low Rank',
                'slug' => 'low-rank',
                'description' => 'Akun dengan rank Iron hingga Platinum',
            ],
            [
                'name' => 'High Rank',
                'slug' => 'high-rank',
                'description' => 'Akun dengan rank Diamond hingga Radiant',
            ],
            [
                'name' => 'Iron',
                'slug' => 'iron',
                'description' => 'Akun dengan rank Iron',
            ],
            [
                'name' => 'Bronze',
                'slug' => 'bronze',
                'description' => 'Akun dengan rank Bronze',
            ],
            [
                'name' => 'Silver',
                'slug' => 'silver',
                'description' => 'Akun dengan rank Silver',
            ],
            [
                'name' => 'Gold',
                'slug' => 'gold',
                'description' => 'Akun dengan rank Gold',
            ],
            [
                'name' => 'Platinum',
                'slug' => 'platinum',
                'description' => 'Akun dengan rank Platinum',
            ],
            [
                'name' => 'Diamond',
                'slug' => 'diamond',
                'description' => 'Akun dengan rank Diamond',
            ],
            [
                'name' => 'Ascendant',
                'slug' => 'ascendant',
                'description' => 'Akun dengan rank Ascendant',
            ],
            [
                'name' => 'Immortal',
                'slug' => 'immortal',
                'description' => 'Akun dengan rank Immortal',
            ],
            [
                'name' => 'Radiant',
                'slug' => 'radiant',
                'description' => 'Akun dengan rank Radiant',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
