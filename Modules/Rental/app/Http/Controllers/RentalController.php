<?php

namespace Modules\Rental\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Rental\App\Repositories\RentalRepositoryInterface;
use Modules\Catalog\App\Repositories\UnitRepositoryInterface;
use Carbon\Carbon;

class RentalController extends Controller
{
    protected RentalRepositoryInterface $rentalRepository;
    protected UnitRepositoryInterface $unitRepository;

    public function __construct(
        RentalRepositoryInterface $rentalRepository,
        UnitRepositoryInterface $unitRepository
    ) {
        $this->rentalRepository = $rentalRepository;
        $this->unitRepository = $unitRepository;
    }

    /**
     * Show rental form
     */
    public function create($unitId)
    {
        $unit = $this->unitRepository->findById($unitId);

        if (!$unit) {
            return redirect()->route('catalog.index')
                ->with('error', 'Unit not found.');
        }

        // Check if unit is available
        if (!$unit->isAvailable()) {
            return redirect()->route('catalog.show', $unitId)
                ->with('error', 'This unit is not available for rent.');
        }

        // Check if user already has 2 active rentals
        $activeRentalsCount = $this->rentalRepository->countUserActiveRentals(Auth::id());
        
        if ($activeRentalsCount >= 2) {
            return redirect()->route('catalog.show', $unitId)
                ->with('error', 'You already have 2 active rentals. Please return one before renting another.');
        }

        return view('rental::create', compact('unit'));
    }

    /**
     * Store rental
     */
    public function store(Request $request, $unitId)
    {
        $validated = $request->validate([
            'rental_days' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $unit = $this->unitRepository->findById($unitId);

        if (!$unit || !$unit->isAvailable()) {
            return back()->with('error', 'Unit is not available.');
        }

        // Check active rentals limit
        $activeRentalsCount = $this->rentalRepository->countUserActiveRentals(Auth::id());
        
        if ($activeRentalsCount >= 2) {
            return back()->with('error', 'You already have 2 active rentals.');
        }

        DB::beginTransaction();
        try {
            // Generate rental code
            $rentalCode = 'RNT-' . strtoupper(uniqid());

            $rentalDays = (int) $validated['rental_days'];
            
            // Calculate dates and price
            $rentalDate = Carbon::now();
            $dueDate = $rentalDate->copy()->addDays($rentalDays);
            $totalPrice = $unit->price_per_day * $rentalDays;

            // Create rental
            $rental = $this->rentalRepository->create([
                'rental_code' => $rentalCode,
                'user_id' => Auth::id(),
                'unit_id' => $unit->id,
                'rental_date' => $rentalDate,
                'due_date' => $dueDate,
                'total_price' => $totalPrice,
                'status' => 'active',
            ]);

            // Update unit status to rented
            $this->unitRepository->update($unit->id, [
                'status' => 'rented',
            ]);

            DB::commit();

            return redirect()->route('rental.show', $rental->id)
                ->with('success', 'Unit rented successfully! Rental Code: ' . $rentalCode);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to rent unit. Please try again.');
        }
    }

    /**
     * Show user's rentals
     */
    public function myRentals()
    {
        $rentals = $this->rentalRepository->getUserRentals(Auth::id());
        
        return view('rental::my-rentals', compact('rentals'));
    }

    /**
     * Show rental detail
     */
    public function show($id)
    {
        $rental = $this->rentalRepository->findById($id);

        if (!$rental) {
            return redirect()->route('rental.my-rentals')
                ->with('error', 'Rental not found.');
        }

        // Check if user owns this rental
        if ($rental->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return redirect()->route('rental.my-rentals')
                ->with('error', 'Unauthorized access.');
        }

        return view('rental::show', compact('rental'));
    }

    public function returnRental($id)
    {
        $rental = $this->rentalRepository->findById($id);

        if (!$rental || $rental->status !== 'active') {
            return redirect()->route('rental.my-rentals')
                ->with('error', 'Rental not found or already returned.');
        }

        // Check if user owns this rental
        if ($rental->user_id !== Auth::id()) {
            return redirect()->route('rental.my-rentals')
                ->with('error', 'Unauthorized access.');
        }

        DB::beginTransaction();
        try {
            // Update rental status to returned
            $this->rentalRepository->update($rental->id, [
                'status' => 'returned',
                'return_date' => Carbon::now(),
            ]);

            // Update unit status to available
            $this->unitRepository->update($rental->unit_id, [
                'status' => 'available',
            ]);

            DB::commit();

            return redirect()->route('rental.my-rentals')
                ->with('success', 'Rental returned successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('rental.my-rentals')
                ->with('error', 'Failed to return rental. Please try again.');
        }
    }
}
