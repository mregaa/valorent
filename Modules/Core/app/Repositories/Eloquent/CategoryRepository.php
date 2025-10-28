<?php

namespace Modules\Core\App\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Core\App\Entities\Category;
use Modules\Core\App\Repositories\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::all();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Category::paginate($perPage);
    }

    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function findBySlug(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $category = Category::find($id);
        if ($category) {
            return $category->update($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $category = Category::find($id);
        if ($category) {
            return $category->delete();
        }
        return false;
    }
}