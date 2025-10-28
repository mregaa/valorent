@extends('auth::layouts.app')

@section('title', 'Rent Unit - Valorent')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('catalog.show', $unit->id) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Unit Details
                </a>
            </div>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Rent Unit</h4>
                </div>
                <div class="card-body">
                    <!-- Unit Info -->
                    <div class="alert alert-info">
                        <h5>{{ $unit->name }}</h5>
                        <p class="mb-0">
                            <strong>Code:</strong> {{ $unit->code }}<br>
                            <strong>Rank:</strong> {{ $unit->rank }}<br>
                            <strong>Price:</strong> Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}/day
                        </p>
                    </div>

                    <!-- Rental Form -->
                    <form method="POST" action="{{ route('rental.store', $unit->id) }}" id="rentalForm">
                        @csrf

                        <!-- Rental Days -->
                        <div class="mb-3">
                            <label for="rental_days" class="form-label">
                                Rental Duration (Days) <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('rental_days') is-invalid @enderror" 
                                   id="rental_days" 
                                   name="rental_days" 
                                   min="1" 
                                   max="5" 
                                   value="{{ old('rental_days', 1) }}" 
                                   required>
                            <small class="form-text text-muted">Maximum 5 days</small>
                            @error('rental_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price Calculation -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h5>Price Summary</h5>
                                <table class="table table-sm mb-0">
                                    <tr>
                                        <td>Price per day:</td>
                                        <td class="text-end">Rp <span id="pricePerDay">{{ number_format($unit->price_per_day, 0, ',', '.') }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Duration:</td>
                                        <td class="text-end"><span id="durationDisplay">1</span> day(s)</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total Price:</td>
                                        <td class="text-end text-primary">Rp <span id="totalPrice">{{ number_format($unit->price_per_day, 0, ',', '.') }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="alert alert-warning">
                            <h6><i class="bi bi-exclamation-triangle"></i> Important Information:</h6>
                            <ul class="mb-0">
                                <li>Maximum rental period is 5 days</li>
                                <li>You can only rent maximum 2 units at a time</li>
                                <li>Late returns will incur a 10% daily fine</li>
                                <li>Contact admin to return the unit</li>
                            </ul>
                        </div>

                        <!-- Agreement Checkbox -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" required>
                            <label class="form-check-label" for="agreement">
                                I agree to the terms and conditions <span class="text-danger">*</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Confirm Rental
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush

@push('scripts')
<script>
    // Calculate total price dynamically
    const pricePerDay = {{ $unit->price_per_day }};
    const rentalDaysInput = document.getElementById('rental_days');
    const durationDisplay = document.getElementById('durationDisplay');
    const totalPriceDisplay = document.getElementById('totalPrice');

    rentalDaysInput.addEventListener('input', function() {
        const days = parseInt(this.value) || 1;
        const total = pricePerDay * days;
        
        durationDisplay.textContent = days;
        totalPriceDisplay.textContent = total.toLocaleString('id-ID');
    });
</script>
@endpush
