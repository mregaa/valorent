<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Catalog\App\Entities\Unit;
use Modules\Rental\App\Entities\Rental;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Get statistics
        $totalUnits = Unit::count();
        $totalUsers = User::count();
        $totalRentals = Rental::count();
        $activeRentals = Rental::where('status', 'active')->count();
        
        // Get recent rentals
        $recentRentals = Rental::with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get rental statistics by month for the last 6 months
        $rentalStats = Rental::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();
            
        // Get units status breakdown
        $unitStatus = Unit::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
            
        // Get top rented units
        $topRentedUnits = Unit::select('units.*', DB::raw('COUNT(rentals.id) as rental_count'))
            ->join('rentals', 'units.id', '=', 'rentals.unit_id')
            ->groupBy(
                'units.id',
                'units.code',
                'units.name',
                'units.description',
                'units.rank',
                'units.level',
                'units.price_per_day',
                'units.image',
                'units.status',
                'units.created_at',
                'units.updated_at'
            )
            ->orderBy('rental_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin::dashboard.index', compact(
            'totalUnits', 
            'totalUsers', 
            'totalRentals', 
            'activeRentals', 
            'recentRentals',
            'rentalStats',
            'unitStatus',
            'topRentedUnits'
        ));
    }
}