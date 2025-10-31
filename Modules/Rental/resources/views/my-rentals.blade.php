@extends('auth::layouts.app')

@section('title', 'My Rentals - Valorent')

@section('content')
<div class="container-fluid px-md-5 py-5" style="background-color: #0f1923; max-width: 1920px; min-height: 100vh;">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="text-white fw-bold" style="font-size: 2.5rem; letter-spacing: 0.1em;">MY RENTALS</h2>
            <p class="text-white-50">View all your rental history</p>
        </div>
    </div>

    @if($rentals->isEmpty())
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="empty-state-card text-center">
                    <i class="bi bi-inbox" style="font-size: 5rem; color: rgba(255,255,255,0.2);"></i>
                    <h3 class="text-white mt-4 mb-3">No Rentals Yet</h3>
                    <p class="text-white-50 mb-4">You haven't rented any units yet. Start exploring our catalog!</p>
                    <a href="{{ route('catalog.index') }}" class="btn-primary-custom">
                        <i class="bi bi-grid-3x3-gap me-2"></i>BROWSE CATALOG
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Summary Cards -->
        <div class="row mb-4 g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-success">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Active Rentals</div>
                        <div class="stat-number text-success">{{ $rentals->where('status', 'active')->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-info">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Rentals</div>
                        <div class="stat-number text-info">{{ $rentals->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Fines</div>
                        <div class="stat-number text-danger">
                            Rp {{ number_format($rentals->sum(fn($r) => $r->getCurrentFine()), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rentals Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="rentals-table-card">
                    <div class="table-responsive">
                        <table class="table rental-table">
                            <thead>
                                <tr>
                                    <th>RENTAL CODE</th>
                                    <th>UNIT</th>
                                    <th>RENTAL DATE</th>
                                    <th>DUE DATE</th>
                                    <th>RETURN DATE</th>
                                    <th>TOTAL PRICE</th>
                                    <th>FINE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rentals as $rental)
                                    <tr class="rental-row">
                                        <td>
                                            <div class="rental-code">{{ $rental->rental_code }}</div>
                                        </td>
                                        <td>
                                            <div class="unit-info">
                                                <div class="unit-name">{{ $rental->unit->name }}</div>
                                                <div class="unit-code">{{ $rental->unit->code }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date-text">{{ $rental->rental_date->format('d M Y') }}</div>
                                        </td>
                                        <td>
                                            <div class="date-text">{{ $rental->due_date->format('d M Y') }}</div>
                                        </td>
                                        <td>
                                            @if($rental->return_date)
                                                <div class="date-text">{{ $rental->return_date->format('d M Y') }}</div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="price-text">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            @php
                                                $currentFine = $rental->getCurrentFine();
                                            @endphp
                                            @if($currentFine > 0)
                                                <div class="fine-text">Rp {{ number_format($currentFine, 0, ',', '.') }}</div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($rental->status === 'active')
                                                @if($rental->isOverdue())
                                                    <span class="status-badge status-overdue">
                                                        <i class="bi bi-exclamation-circle me-1"></i>OVERDUE
                                                    </span>
                                                @else
                                                    <span class="status-badge status-active">
                                                        <i class="bi bi-check-circle me-1"></i>ACTIVE
                                                    </span>
                                                @endif
                                            @else
                                                <span class="status-badge status-returned">
                                                    <i class="bi bi-archive me-1"></i>RETURNED
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('rental.show', $rental->id) }}" class="btn-action">
                                                <i class="bi bi-eye me-1"></i>VIEW
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    body {
        background-color: #0f1923;
    }

    /* Empty State */
    .empty-state-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 4rem 2rem;
    }

    .btn-primary-custom {
        display: inline-block;
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        color: white;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 1rem 2rem;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 68, 68, 0.4);
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #ff6666 0%, #ff4444 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 68, 68, 0.6);
        color: white;
    }

    /* Stat Cards */
    .stat-card {
        background: linear-gradient(135deg, #1a2332 0%, #151e2b 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255, 68, 68, 0.3);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .stat-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
    }

    /* Table Card */
    .rentals-table-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 2rem;
    }

    /* Rental Table */
    .rental-table {
        margin-bottom: 0;
        background-color: transparent;
    }

    .rental-table thead {
        background-color: #0d1520;
    }

    .rental-table thead th {
        background-color: #0d1520;
        color: #9ca3af;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 1rem;
        border: none;
        text-align: left;
        white-space: nowrap;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .rental-table tbody {
        background-color: #1a2332;
    }

    .rental-row {
        background-color: #1a2332;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .rental-row:hover {
        background-color: #1e2a3a;
    }

    .rental-row td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border: none;
        color: #e5e7eb;
        background-color: transparent;
    }

    .rental-code {
        font-weight: 700;
        color: #fff;
        font-size: 0.95rem;
        letter-spacing: 0.05em;
    }

    .unit-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .unit-name {
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .unit-code {
        color: #9ca3af;
        font-size: 0.75rem;
    }

    .date-text {
        color: #d1d5db;
        font-size: 0.9rem;
    }

    .price-text {
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .fine-text {
        color: #ef4444;
        font-weight: 700;
        font-size: 0.95rem;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        white-space: nowrap;
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

    /* Action Button */
    .btn-action {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 68, 68, 0.1);
        color: #ff4444;
        border: 1px solid rgba(255, 68, 68, 0.3);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-action:hover {
        background: #ff4444;
        color: white;
        border-color: #ff4444;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .table-responsive {
            overflow-x: auto;
        }

        .rental-table {
            min-width: 1200px;
        }
    }
</style>
@endpush