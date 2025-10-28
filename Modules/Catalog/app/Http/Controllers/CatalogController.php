<?php

namespace Modules\Catalog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Catalog\App\Repositories\UnitRepositoryInterface;
use Modules\Core\App\Repositories\CategoryRepositoryInterface;

class CatalogController extends Controller
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

    /**
     * Display catalog page with all available units
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->all();
        
        // Get filter parameters
        $categoryId = $request->get('category');
        $search = $request->get('search');

        // Get units based on filters
        if ($search) {
            $units = $this->unitRepository->searchByName($search);
        } elseif ($categoryId) {
            $units = $this->unitRepository->filterByCategory($categoryId);
        } else {
            $units = $this->unitRepository->getAvailableUnits();
        }

        return view('catalog::index', compact('units', 'categories', 'categoryId', 'search'));
    }

    /**
     * Show unit detail
     */
    public function show($id)
    {
        $unit = $this->unitRepository->findById($id);

        if (!$unit) {
            return redirect()->route('catalog.index')
                ->with('error', 'Unit not found.');
        }

        return view('catalog::show', compact('unit'));
    }
}
