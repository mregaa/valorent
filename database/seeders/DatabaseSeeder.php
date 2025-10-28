<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        $this->call([
            \Modules\Core\Database\Seeders\CoreDatabaseSeeder::class,
            \Modules\Auth\Database\Seeders\AuthDatabaseSeeder::class,
            \Modules\Catalog\Database\Seeders\CatalogDatabaseSeeder::class,
        ]);
    }
}
