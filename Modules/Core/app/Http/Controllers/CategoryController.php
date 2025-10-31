<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request): View
    {
        $search = $request->get('search');
        
        if ($search) {
            $categories = $this->categoryRepository->search($search)->paginate(10);
        } else {
            $categories = $this->categoryRepository->paginate(10);
        }
        
        return view('core::categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('core::categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $this->categoryRepository->create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(int $category): View
    {
        $category = $this->categoryRepository->findById($category);
        
        if (!$category) {
            abort(404, 'Category not found');
        }

        return view('core::categories.show', compact('category'));
    }

    public function edit(int $category): View
    {
        $category = $this->categoryRepository->findById($category);
        
        if (!$category) {
            abort(404, 'Category not found');
        }

        return view('core::categories.edit', compact('category'));
    }

    public function update(Request $request, int $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categoryModel = $this->categoryRepository->findById($category);
        
        if (!$categoryModel) {
            abort(404, 'Category not found');
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $this->categoryRepository->update($category, $data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(int $category): RedirectResponse
    {
        $categoryObj = $this->categoryRepository->findById($category);
        
        if (!$categoryObj) {
            abort(404, 'Category not found');
        }

        $this->categoryRepository->delete($categoryObj->id);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}