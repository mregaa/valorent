<?php

namespace Modules\Catalog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Catalog\App\Entities\Unit;
use Modules\Core\App\Entities\Category;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $sultanCategory = Category::where('slug', 'sultan')->first();
        $lowRankCategory = Category::where('slug', 'low-rank')->first();
        $highRankCategory = Category::where('slug', 'high-rank')->first();
        $ironCategory = Category::where('slug', 'iron')->first();
        $goldCategory = Category::where('slug', 'gold')->first();
        $diamondCategory = Category::where('slug', 'diamond')->first();
        $immortalCategory = Category::where('slug', 'immortal')->first();
        $radiantCategory = Category::where('slug', 'radiant')->first();

        // Unit 1: Sultan + Immortal
        $unit1 = Unit::create([
            'code' => 'VAL-001',
            'name' => 'Akun Sultan Immortal',
            'description' => 'Akun dengan skin lengkap dan rank Immortal 3',
            'rank' => 'Immortal 3',
            'level' => 150,
            'price_per_day' => 50000,
            'status' => 'available',
        ]);
        $unit1->categories()->attach([$sultanCategory->id, $highRankCategory->id, $immortalCategory->id]);

        // Unit 2: Sultan + Radiant
        $unit2 = Unit::create([
            'code' => 'VAL-002',
            'name' => 'Akun Sultan Radiant',
            'description' => 'Akun dengan skin premium dan rank Radiant',
            'rank' => 'Radiant',
            'level' => 200,
            'price_per_day' => 100000,
            'status' => 'available',
        ]);
        $unit2->categories()->attach([$sultanCategory->id, $highRankCategory->id, $radiantCategory->id]);

        // Unit 3: Low Rank - Iron
        $unit3 = Unit::create([
            'code' => 'VAL-003',
            'name' => 'Akun Iron Murah',
            'description' => 'Akun rank Iron untuk latihan',
            'rank' => 'Iron 2',
            'level' => 20,
            'price_per_day' => 10000,
            'status' => 'available',
        ]);
        $unit3->categories()->attach([$lowRankCategory->id, $ironCategory->id]);

        // Unit 4: Low Rank - Gold
        $unit4 = Unit::create([
            'code' => 'VAL-004',
            'name' => 'Akun Gold Standard',
            'description' => 'Akun rank Gold dengan beberapa skin',
            'rank' => 'Gold 3',
            'level' => 80,
            'price_per_day' => 25000,
            'status' => 'available',
        ]);
        $unit4->categories()->attach([$lowRankCategory->id, $goldCategory->id]);

        // Unit 5: High Rank - Diamond
        $unit5 = Unit::create([
            'code' => 'VAL-005',
            'name' => 'Akun Diamond Pro',
            'description' => 'Akun rank Diamond dengan skin bagus',
            'rank' => 'Diamond 2',
            'level' => 120,
            'price_per_day' => 40000,
            'status' => 'available',
        ]);
        $unit5->categories()->attach([$highRankCategory->id, $diamondCategory->id]);

        // Unit 6: Sultan + Immortal (nama sama dengan unit 1, beda kode)
        $unit6 = Unit::create([
            'code' => 'VAL-006',
            'name' => 'Akun Sultan Immortal',
            'description' => 'Akun dengan skin premium dan rank Immortal 2',
            'rank' => 'Immortal 2',
            'level' => 140,
            'price_per_day' => 45000,
            'status' => 'available',
        ]);
        $unit6->categories()->attach([$sultanCategory->id, $highRankCategory->id, $immortalCategory->id]);

        // Unit 7: Low Rank - Iron (untuk testing multiple units)
        $unit7 = Unit::create([
            'code' => 'VAL-007',
            'name' => 'Akun Iron Pemula',
            'description' => 'Akun rank Iron untuk pemula',
            'rank' => 'Iron 1',
            'level' => 15,
            'price_per_day' => 8000,
            'status' => 'available',
        ]);
        $unit7->categories()->attach([$lowRankCategory->id, $ironCategory->id]);

        // Unit 8: High Rank - Diamond
        $unit8 = Unit::create([
            'code' => 'VAL-008',
            'name' => 'Akun Diamond Elite',
            'description' => 'Akun rank Diamond 3 siap push Ascendant',
            'rank' => 'Diamond 3',
            'level' => 130,
            'price_per_day' => 42000,
            'status' => 'available',
        ]);
        $unit8->categories()->attach([$highRankCategory->id, $diamondCategory->id]);
    }
}
