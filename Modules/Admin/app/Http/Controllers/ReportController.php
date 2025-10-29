<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Modules\Catalog\App\Entities\Unit;
use Modules\Rental\App\Entities\Rental;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('admin::reports.index');
    }

    public function rentalHistory(Request $request): View
    {
        $search = $request->get('search');
        
        $query = Rental::with(['user', 'unit']);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('rental_code', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('unit', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('code', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $rentals = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin::reports.rental-history', compact('rentals'));
    }

    public function unitStatusReport(): View
    {
        $units = Unit::with('categories')
            ->orderBy('status')
            ->orderBy('name')
            ->get();

        return view('admin::reports.unit-status', compact('units'));
    }

    public function userActivityReport(): View
    {
        $users = User::withCount(['rentals'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin::reports.user-activity', compact('users'));
    }

    public function revenueReport(Request $request): View
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Rental::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $revenueData = $query->get();

        // Calculate totals
        $totalRentals = collect($revenueData)->sum('count');
        $totalRevenue = collect($revenueData)->sum('revenue');

        return view('admin::reports.revenue', compact('revenueData', 'totalRentals', 'totalRevenue', 'startDate', 'endDate'));
    }

    public function exportRentalHistory(): Response
    {
        $rentals = Rental::with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Create CSV content
        $headers = ['ID', 'User', 'Unit', 'Start Date', 'End Date', 'Total Price', 'Status', 'Created At'];
        $rows = [];

        foreach ($rentals as $rental) {
            $rows[] = [
                $rental->id,
                $rental->user->name,
                $rental->unit->name,
                $rental->start_date,
                $rental->end_date,
                $rental->total_price,
                $rental->status,
                $rental->created_at->format('Y-m-d H:i:s')
            ];
        }

        // Generate CSV
        $csv = implode(',', $headers) . "\n";
        foreach ($rows as $row) {
            $csv .= '"' . implode('","', $row) . '"' . "\n";
        }

        // Return as download
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="rental-history-' . date('Y-m-d') . '.csv"');
    }
}