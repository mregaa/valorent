@extends('auth::layouts.app')

@section('title', 'Rent Unit - Valorent')

@section('content')
<div class="container-fluid px-md-5 py-5" style="background-color: #0f1923; max-width: 1920px; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('catalog.show', $unit->id) }}" class="btn-back">
                    <i class="bi bi-arrow-left me-2"></i> Back to Unit Details
                </a>
            </div>

            <!-- Main Card -->
            <div class="rent-card">
                <div class="rent-header">
                    <h3 class="text-white fw-bold mb-0" style="letter-spacing: 0.1em;">
                        <i class="bi bi-cart-plus me-2"></i>RENT UNIT
                    </h3>
                </div>

                <div class="rent-body">
                    <!-- Unit Info Card -->
                    <div class="unit-info-card mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="text-white mb-2">{{ strtoupper($unit->name) }}</h4>
                                <div class="unit-details">
                                    <span class="detail-item">
                                        <i class="bi bi-code-square text-info me-1"></i>
                                        <strong>Code:</strong> {{ $unit->code }}
                                    </span>
                                    <span class="detail-item">
                                        <i class="bi bi-trophy text-warning me-1"></i>
                                        <strong>Rank:</strong> {{ $unit->rank }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <div class="price-display">
                                    <div class="price-label">PRICE/DAY</div>
                                    <div class="price-amount">Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Form -->
                    <form method="POST" action="{{ route('rental.store', $unit->id) }}" id="rentalForm">
                        @csrf

                        <!-- Rental Days Input -->
                        <div class="form-group-custom mb-4">
                            <label for="rental_days" class="form-label-custom">
                                <i class="bi bi-calendar-range me-2"></i>RENTAL DURATION (DAYS)
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-custom @error('rental_days') is-invalid @enderror" 
                                   id="rental_days" 
                                   name="rental_days" 
                                   min="1" 
                                   max="5" 
                                   value="{{ old('rental_days', 1) }}" 
                                   required>
                            <small class="form-hint">Maximum 5 days rental period</small>
                            @error('rental_days')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price Summary -->
                        <div class="price-summary-card mb-4">
                            <h5 class="summary-title">
                                <i class="bi bi-receipt me-2"></i>PRICE SUMMARY
                            </h5>
                            <div class="summary-content">
                                <div class="summary-row">
                                    <span>Price per day:</span>
                                    <span>Rp <span id="pricePerDay">{{ number_format($unit->price_per_day, 0, ',', '.') }}</span></span>
                                </div>
                                <div class="summary-row">
                                    <span>Duration:</span>
                                    <span><span id="durationDisplay">1</span> day(s)</span>
                                </div>
                                <div class="summary-divider"></div>
                                <div class="summary-row summary-total">
                                    <span>Total Price:</span>
                                    <span class="text-danger">Rp <span id="totalPrice">{{ number_format($unit->price_per_day, 0, ',', '.') }}</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions Alert -->
                        <div class="warning-card mb-4">
                            <div class="warning-header">
                                <i class="bi bi-exclamation-triangle me-2"></i>IMPORTANT INFORMATION
                            </div>
                            <ul class="warning-list">
                                <li>Maximum rental period is 5 days</li>
                                <li>You can only rent maximum 2 units at a time</li>
                                <li>Late returns will incur a 10% daily fine</li>
                            </ul>
                        </div>

                        <!-- Agreement Checkbox -->
                        <div class="agreement-section mb-4">
                            <label class="agreement-label">
                                <input type="checkbox" class="agreement-checkbox" id="agreement" required>
                                <span class="agreement-text">
                                    I agree to the terms and conditions
                                    <span class="text-danger">*</span>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-confirm w-100">
                            <i class="bi bi-check-circle me-2"></i>CONFIRM RENTAL
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    body {
        background-color: #0f1923;
    }

    /* Back Button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.05);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: rgba(255, 68, 68, 0.1);
        border-color: #ff4444;
        color: #ff4444;
        transform: translateX(-5px);
    }

    /* Main Card */
    .rent-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .rent-header {
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        padding: 1.5rem 2rem;
    }

    .rent-body {
        padding: 2rem;
    }

    /* Unit Info Card */
    .unit-info-card {
        background: rgba(255, 68, 68, 0.1);
        border: 1px solid rgba(255, 68, 68, 0.3);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .unit-details {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 0.5rem;
    }

    .detail-item {
        color: #d1d5db;
        font-size: 0.9rem;
    }

    .detail-item strong {
        color: white;
    }

    .price-display {
        background: rgba(0, 0, 0, 0.3);
        border-radius: 6px;
        padding: 1rem;
    }

    .price-label {
        font-size: 0.7rem;
        color: #9ca3af;
        letter-spacing: 0.1em;
        margin-bottom: 0.25rem;
    }

    .price-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ff4444;
    }

    /* Form Elements */
    .form-group-custom {
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        display: block;
        color: white;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 0.75rem;
    }

    .form-control-custom {
        width: 100%;
        background: rgba(26, 35, 50, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        padding: 1rem;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #ff4444;
        box-shadow: 0 0 0 3px rgba(255, 68, 68, 0.2);
        background: rgba(26, 35, 50, 1);
    }

    .form-hint {
        display: block;
        color: #9ca3af;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Price Summary Card */
    .price-summary-card {
        background: rgba(26, 35, 50, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .summary-title {
        color: white;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 1rem;
    }

    .summary-content {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        color: #d1d5db;
        font-size: 0.95rem;
    }

    .summary-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 0.5rem 0;
    }

    .summary-total {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
    }

    /* Warning Card */
    .warning-card {
        background: rgba(251, 191, 36, 0.1);
        border: 1px solid rgba(251, 191, 36, 0.3);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .warning-header {
        color: #fbbf24;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 1rem;
    }

    .warning-list {
        color: #d1d5db;
        font-size: 0.9rem;
        margin: 0;
        padding-left: 1.5rem;
    }

    .warning-list li {
        margin-bottom: 0.5rem;
    }

    /* Agreement Section */
    .agreement-section {
        background: rgba(26, 35, 50, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1.25rem;
    }

    .agreement-label {
        display: flex;
        align-items: start;
        gap: 1rem;
        margin: 0;
        cursor: pointer;
    }

    .agreement-checkbox {
        width: 20px;
        height: 20px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #ff4444;
    }

    .agreement-text {
        color: #d1d5db;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Confirm Button */
    .btn-confirm {
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 1.25rem;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 68, 68, 0.4);
    }

    .btn-confirm:hover {
        background: linear-gradient(135deg, #ff6666 0%, #ff4444 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 68, 68, 0.6);
    }

    /* Responsive */
    @media (max-width: 767px) {
        .rent-body {
            padding: 1.5rem;
        }

        .price-display {
            text-align: left !important;
        }
    }
</style>
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