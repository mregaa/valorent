@extends('auth::layouts.app')

@section('title', 'Rental Details - Valorent')

@section('content')
<div class="container">
    <div class="row">
        <!-- Back Button -->
        <div class="col-md-12 mb-3">
            <a href="{{ route('rental.my-rentals') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to My Rentals
            </a>
        </div>

        <!-- Rental Details -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Rental Details</h4>
                </div>
                <div class="card-body">
                    <!-- Rental Code -->
                    <div class="mb-3">
                        <h5>Rental Code</h5>
                        <h3 class="text-primary">{{ $rental->rental_code }}</h3>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <h5>Status</h5>
                        @if($rental->status === 'active')
                            @if($rental->isOverdue())
                                <span class="badge bg-danger fs-6">Overdue</span>
                                <p class="text-danger mt-2">
                                    <i class="bi bi-exclamation-triangle"></i> 
                                    This rental is overdue! Please contact admin to return.
                                </p>
                            @else
                                <span class="badge bg-success fs-6">Active</span>
                            @endif
                        @else
                            <span class="badge bg-secondary fs-6">Returned</span>
                        @endif
                    </div>

                    <!-- Unit Information -->
                    <div class="mb-3">
                        <h5>Unit Information</h5>
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>{{ $rental->unit->name }}</h6>
                                <p class="mb-1"><strong>Code:</strong> {{ $rental->unit->code }}</p>
                                <p class="mb-1"><strong>Rank:</strong> {{ $rental->unit->rank }}</p>
                                <p class="mb-0"><strong>Level:</strong> {{ $rental->unit->level }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Information -->
                    <div class="mb-3">
                        <h5>Rental Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Rental Date</th>
                                <td>{{ $rental->rental_date->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Due Date</th>
                                <td>{{ $rental->due_date->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Return Date</th>
                                <td>
                                    @if($rental->return_date)
                                        {{ $rental->return_date->format('d F Y') }}
                                    @else
                                        <span class="text-muted">Not returned yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <td>{{ $rental->rental_date->diffInDays($rental->due_date) }} days</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Price Information -->
                    <div class="mb-3">
                        <h5>Price Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Total Price</th>
                                <td>Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Fine</th>
                                <td>
                                    @if($rental->fine > 0)
                                        <span class="text-danger">
                                            Rp {{ number_format($rental->fine, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-success">No fine</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="table-primary">
                                <th>Grand Total</th>
                                <th>Rp {{ number_format($rental->total_price + $rental->fine, 0, ',', '.') }}</th>
                            </tr>
                        </table>
                    </div>

                    <!-- Contact Admin -->
                    @if($rental->status === 'active')
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Need to return?</h6>
                            <p class="mb-0">Please contact admin to process the return of this unit.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- User Info -->
            <div class="card shadow mb-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Renter Information</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Name:</strong> {{ $rental->user->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $rental->user->email }}</p>
                    @if($rental->user->profile)
                        <p class="mb-0"><strong>Phone:</strong> {{ $rental->user->profile->phone ?? '-' }}</p>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Timeline</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success"></i>
                            <strong>Rented:</strong><br>
                            <small>{{ $rental->created_at->format('d M Y H:i') }}</small>
                        </li>
                        @if($rental->return_date)
                            <li>
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Returned:</strong><br>
                                <small>{{ $rental->return_date->format('d M Y H:i') }}</small>
                            </li>
                        @else
                            <li>
                                <i class="bi bi-clock text-warning"></i>
                                <strong>Pending Return</strong>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush
