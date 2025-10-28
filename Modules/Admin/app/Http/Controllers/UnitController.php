<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Catalog\App\Repositories\UnitRepositoryInterface;
use Modules\Core\App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class UnitController extends Controller
{
    protected UnitRepositoryInterface $unitRepository;
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        UnitRepositoryInterface $unitRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->unitRepository = $unitRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): View
    {
        $units = $this->unitRepository->paginate(10);
        return view('admin::units.index', compact('units'));
    }

    public function create(): View
    {
        $categories = $this->categoryRepository->all();
        return view('admin::units.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:units,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rank' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/units', $imageName);
            $data['image'] = 'storage/units/' . $imageName;
        }

        $unit = $this->unitRepository->create($data);

        // Handle category assignment
        if ($request->has('categories')) {
            $this->unitRepository->attachCategories($unit->id, $request->categories);
        }

        return redirect()->route('admin.units.index')
            ->with('success', 'Unit created successfully.');
    }

    public function show(int $unit): View
    {
        $unit = $this->unitRepository->findById($unit);
        
        if (!$unit) {
            abort(404, 'Unit not found');
        }

        return view('admin::units.show', compact('unit'));
    }

    public function edit(int $unit): View
    {
        $unit = $this->unitRepository->findById($unit);
        $categories = $this->categoryRepository->all();
        
        if (!$unit) {
            abort(404, 'Unit not found');
        }

        return view('admin::units.edit', compact('unit', 'categories'));
    }

    public function update(Request $request, int $unit): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:units,code,' . $unit,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rank' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        $unitModel = $this->unitRepository->findById($unit);
        
        if (!$unitModel) {
            abort(404, 'Unit not found');
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/units', $imageName);
            $data['image'] = 'storage/units/' . $imageName;

            // Delete old image if exists
            if ($unitModel->image && file_exists(public_path($unitModel->image))) {
                unlink(public_path($unitModel->image));
            }
        } elseif ($request->has('remove_image') && $request->remove_image) {
            // Delete old image if requested
            if ($unitModel->image && file_exists(public_path($unitModel->image))) {
                unlink(public_path($unitModel->image));
            }
            $data['image'] = null;
        } else {
            // Don't update image if no new image is provided
            unset($data['image']);
        }

        $this->unitRepository->update($unit, $data);

        // Handle category assignment
        if ($request->has('categories')) {
            $this->unitRepository->syncCategories($unit, $request->categories);
        }

        return redirect()->route('admin.units.index')
            ->with('success', 'Unit updated successfully.');
    }

    public function destroy(int $unit): RedirectResponse
    {
        $unit = $this->unitRepository->findById($unit);
        
        if (!$unit) {
            abort(404, 'Unit not found');
        }

        // Delete image if exists
        if ($unit->image && file_exists(public_path($unit->image))) {
            unlink(public_path($unit->image));
        }

        $this->unitRepository->delete($unit);

        return redirect()->route('admin.units.index')
            ->with('success', 'Unit deleted successfully.');
    }
}