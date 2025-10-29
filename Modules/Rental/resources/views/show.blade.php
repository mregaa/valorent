@extends('auth::layouts.app')

@section('title', 'Rental Details - Valorent')

@section('content')
<div class="container-fluid px-md-5 py-5" style="background-color: #0f1923; max-width: 1920px; min-height: 100vh;">
    <!-- Back Button -->
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('rental.my-rentals') }}" class="btn-back">
                <i class="bi bi-arrow-left me-2"></i> Back to My Rentals
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="detail-card">
                <!-- Header with Rental Code -->
                <div class="detail-header">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h3 class="text-white fw-bold mb-2" style="letter-spacing: 0.1em;">RENTAL DETAILS</h3>
                            <div class="rental-code-display">{{ $rental->rental_code }}</div>
                        </div>
                        <div>
                            @if($rental->status === 'active')
                                @if($rental->isOverdue())
                                    <span class="status-badge-large status-overdue">
                                        <i class="bi bi-exclamation-circle me-2"></i>OVERDUE
                                    </span>
                                @else
                                    <span class="status-badge-large status-active">
                                        <i class="bi bi-check-circle me-2"></i>ACTIVE
                                    </span>
                                @endif
                            @else
                                <span class="status-badge-large status-returned">
                                    <i class="bi bi-archive me-2"></i>RETURNED
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($rental->status === 'active' && $rental->isOverdue())
                        <div class="overdue-alert mt-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <span>This rental is overdue! Please return it immediately!.</span>
                        </div>
                    @endif
                </div>

                <!-- Unit Information -->
                <div class="info-section">
                    <h5 class="section-title">
                        <i class="bi bi-controller me-2"></i>UNIT INFORMATION
                    </h5>
                    <div class="unit-detail-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="text-white mb-3">{{ strtoupper($rental->unit->name) }}</h4>
                                <div class="unit-specs">
                                    <div class="spec-item">
                                        <i class="bi bi-code-square text-info"></i>
                                        <span class="spec-label">Code:</span>
                                        <span class="spec-value">{{ $rental->unit->code }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <i class="bi bi-trophy text-warning"></i>
                                        <span class="spec-label">Rank:</span>
                                        <span class="spec-value">{{ $rental->unit->rank }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <i class="bi bi-star text-success"></i>
                                        <span class="spec-label">Level:</span>
                                        <span class="spec-value">{{ $rental->unit->level }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rental Information -->
                <div class="info-section">
                    <h5 class="section-title">
                        <i class="bi bi-calendar-check me-2"></i>RENTAL INFORMATION
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Rental Date</div>
                            <div class="info-value">{{ $rental->rental_date->format('d F Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Due Date</div>
                            <div class="info-value">{{ $rental->due_date->format('d F Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Return Date</div>
                            <div class="info-value">
                                @if($rental->return_date)
                                    {{ $rental->return_date->format('d F Y') }}
                                @else
                                    <span class="text-muted">Not returned yet</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Duration</div>
                            <div class="info-value">{{ $rental->rental_date->diffInDays($rental->due_date) }} days</div>
                        </div>
                    </div>
                </div>

                <!-- Price Information -->
                <div class="info-section">
                    <h5 class="section-title">
                        <i class="bi bi-receipt me-2"></i>PRICE INFORMATION
                    </h5>
                    <div class="price-breakdown">
                        <div class="price-row">
                            <span>Total Price</span>
                            <span>Rp {{ number_format($rental->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="price-row">
                            <span>Fine</span>
                            <span>
                                @if($rental->fine > 0)
                                    <span class="text-danger fw-bold">
                                        Rp {{ number_format($rental->fine, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-success">No fine</span>
                                @endif
                            </span>
                        </div>
                        <div class="price-divider"></div>
                        <div class="price-row price-total">
                            <span>Grand Total</span>
                            <span class="text-danger">Rp {{ number_format($rental->total_price + $rental->fine, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Admin -->
                 @if($rental->status === 'active')
                    <div class="info-section">
                        <h5 class="section-title">
                            <i class="bi bi-receipt me-2"></i>RETURN RENTAL
                        </h5>
                        <form action="{{ route('rental.return', $rental->id) }}" method="POST" style="display:inline-block; margin-left: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-archive me-2"></i> Kembalikan Rental
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- User Info Card -->
            <div class="sidebar-card mb-4">
                <div class="sidebar-header">
                    <i class="bi bi-person-circle me-2"></i>RENTER INFORMATION
                </div>
                <div class="sidebar-content">
                    <div class="user-info-item">
                        <div class="user-info-label">Name</div>
                        <div class="user-info-value">{{ $rental->user->name }}</div>
                    </div>
                    <div class="user-info-item">
                        <div class="user-info-label">Email</div>
                        <div class="user-info-value">{{ $rental->user->email }}</div>
                    </div>
                    @if($rental->user->profile)
                        <div class="user-info-item">
                            <div class="user-info-label">Phone</div>
                            <div class="user-info-value">{{ $rental->user->profile->phone ?? '-' }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <i class="bi bi-clock-history me-2"></i>TIMELINE
                </div>
                <div class="sidebar-content">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-success">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Rented</div>
                                <div class="timeline-date">{{ $rental->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        @if($rental->return_date)
                            <div class="timeline-item">
                                <div class="timeline-icon bg-success">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Returned</div>
                                    <div class="timeline-date">{{ $rental->return_date->format('d M Y H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-icon bg-warning">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pending Return</div>
                                    <div class="timeline-date text-warning">In progress</div>
                                </div>
                            </div>
                        @endif
                    </div>
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

    /* Detail Card */
    .detail-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .detail-header {
        background: linear-gradient(135deg, #1a2332 0%, #151e2b 100%);
        border-bottom: 2px solid rgba(255, 68, 68, 0.3);
        padding: 2rem;
    }

    .rental-code-display {
        background: rgba(255, 68, 68, 0.1);
        border: 1px solid rgba(255, 68, 68, 0.3);
        border-radius: 6px;
        padding: 0.75rem 1.5rem;
        display: inline-block;
        color: #ff4444;
        font-weight: 700;
        font-size: 1.25rem;
        letter-spacing: 0.1em;
    }

    /* Status Badges */
    .status-badge-large {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
    }

    .status-active {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .status-overdue {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-returned {
        background: rgba(107, 114, 128, 0.15);
        color: #9ca3af;
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    .overdue-alert {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 6px;
        padding: 1rem;
        color: #ef4444;
        font-size: 0.9rem;
    }

    /* Info Sections */
    .info-section {
        padding: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-section:last-child {
        border-bottom: none;
    }

    .section-title {
        color: white;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 1.5rem;
    }

    /* Unit Detail Box */
    .unit-detail-box {
        background: rgba(26, 35, 50, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .unit-specs {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .spec-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #d1d5db;
        font-size: 0.95rem;
    }

    .spec-item i {
        font-size: 1.25rem;
    }

    .spec-label {
        color: #9ca3af;
        min-width: 50px;
    }

    .spec-value {
        color: white;
        font-weight: 600;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .info-item {
        background: rgba(26, 35, 50, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        padding: 1.25rem;
    }

    .info-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .info-value {
        font-size: 1rem;
        color: white;
        font-weight: 600;
    }

    /* Price Breakdown */
    .price-breakdown {
        background: rgba(26, 35, 50, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        color: #d1d5db;
        font-size: 0.95rem;
    }

    .price-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 0.75rem 0;
    }

    .price-total {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
        padding-top: 1rem;
    }

    /* Contact Alert */
    .contact-alert {
        margin: 2rem;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 8px;
        padding: 1.5rem;
        color: #60a5fa;
        display: flex;
        gap: 1rem;
    }

    .contact-alert strong {
        color: white;
    }

    .contact-alert p {
        color: #d1d5db;
    }

    /* Sidebar Cards */
    .sidebar-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .sidebar-header {
        background: rgba(255, 68, 68, 0.1);
        border-bottom: 1px solid rgba(255, 68, 68, 0.3);
        padding: 1.25rem;
        color: white;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.1em;
    }

    .sidebar-content {
        padding: 1.5rem;
    }

    /* User Info */
    .user-info-item {
        margin-bottom: 1.25rem;
    }

    .user-info-item:last-child {
        margin-bottom: 0;
    }

    .user-info-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .user-info-value {
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Timeline */
    .timeline {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .timeline-item {
        display: flex;
        align-items: start;
        gap: 1rem;
    }

    .timeline-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-title {
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }

    .timeline-date {
        color: #9ca3af;
        font-size: 0.85rem;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .detail-header {
            padding: 1.5rem;
        }

        .info-section {
            padding: 1.5rem;
        }
    }
</style>
@endpush