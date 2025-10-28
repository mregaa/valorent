<?php

namespace Modules\Core\App\Repositories\Eloquent;

use Modules\Core\App\Repositories\CategoryRepositoryInterface;
use Modules\Core\App\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->orderBy('name')->get();
    }

    public function findById(int $id): ?Category
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?Category
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create(array $data): Category
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $category = $this->findById($id);
        
        if (!$category) {
            return false;
        }

        return $category->update($data);
    }

    public function delete(int $id): bool
    {
        $category = $this->findById($id);
        
        if (!$category) {
            return false;
        }

        return $category->delete();
    }
}
