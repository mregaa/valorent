<?php

namespace Modules\Core\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Core\App\Entities\Category;
use Modules\Core\App\Repositories\CategoryRepositoryInterface;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected CategoryRepositoryInterface $categoryRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryRepository = $this->app->make(CategoryRepositoryInterface::class);
    }

    public function test_it_can_create_category(): void
    {
        $data = [
            'name' => 'Sultan',
            'slug' => 'sultan',
            'description' => 'Accounts with high Valorant Points'
        ];

        $category = $this->categoryRepository->create($data);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals('Sultan', $category->name);
        $this->assertEquals('sultan', $category->slug);
    }

    public function test_it_can_find_category_by_id(): void
    {
        $category = Category::factory()->create();

        $foundCategory = $this->categoryRepository->findById($category->id);

        $this->assertInstanceOf(Category::class, $foundCategory);
        $this->assertEquals($category->id, $foundCategory->id);
    }

    public function test_it_returns_null_when_category_not_found_by_id(): void
    {
        $category = $this->categoryRepository->findById(999);

        $this->assertNull($category);
    }

    public function test_it_can_find_category_by_slug(): void
    {
        $category = Category::factory()->create([
            'slug' => 'high-rank'
        ]);

        $foundCategory = $this->categoryRepository->findBySlug('high-rank');

        $this->assertInstanceOf(Category::class, $foundCategory);
        $this->assertEquals($category->slug, $foundCategory->slug);
    }

    public function test_it_returns_null_when_category_not_found_by_slug(): void
    {
        $category = $this->categoryRepository->findBySlug('non-existent');

        $this->assertNull($category);
    }

    public function test_it_can_update_category(): void
    {
        $category = Category::factory()->create([
            'name' => 'Old Name',
            'description' => 'Old Description'
        ]);

        $updated = $this->categoryRepository->update($category->id, [
            'name' => 'New Name',
            'description' => 'New Description'
        ]);

        $this->assertTrue($updated);

        $updatedCategory = Category::find($category->id);
        $this->assertEquals('New Name', $updatedCategory->name);
        $this->assertEquals('New Description', $updatedCategory->description);
    }

    public function test_it_can_delete_category(): void
    {
        $category = Category::factory()->create();

        $deleted = $this->categoryRepository->delete($category->id);

        $this->assertTrue($deleted);
        $this->assertNull(Category::find($category->id));
    }
}