@extends('auth::layouts.app')

@section('title', 'My Rentals - Valorent')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>My Rentals</h2>
            <p class="text-muted">View all your rental history</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($rentals->isEmpty())
                <div class="alert alert-info text-center">
                    <h5>No rentals yet</h5>
                    <p>You haven't rented any units yet.</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary">
                        Browse Catalog
                    </a>
                </div>
            @else
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Rental Code</th>
                                        <th>Unit</th>
                                        <th>Rental Date</th>
                                        <th>Due Date</th>
                                        <th>Return Date</th>
                                        <th>Total Price</th>
                                        <th>Fine</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rentals as $rental)
                                        <tr>
                                            <td>
                                                <strong>{{ $rental->rental_code }}</strong>
                                            </td>
                                            <td>
                                                {{ $rental->unit->name }}<br>
                                                <small class="text-muted">{{ $rental->unit->code }}</small>
                                            </td>
                                            <td>{{ $rental->rental_date->format('d M Y') }}</td>
                                            <td>{{ $rental->due_date->format('d M Y') }}</td>
                                            <td>
                                                @if($rental->return_date)
                                                    {{ $rental->return_date->format('d M Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                @if($rental->fine > 0)
                                                    <span class="text-danger">
                                                        Rp {{ number_format($rental->fine, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rental->status === 'active')
                                                    @if($rental->isOverdue())
                                                        <span class="badge bg-danger">Overdue</span>
                                                    @else
                                                        <span class="badge bg-success">Active</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Returned</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('rental.show', $rental->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i> Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Active Rentals</h5>
                                <h2 class="text-primary">{{ $rentals->where('status', 'active')->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Total Rentals</h5>
                                <h2 class="text-info">{{ $rentals->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Total Fines</h5>
                                <h2 class="text-danger">Rp {{ number_format($rentals->sum('fine'), 0, ',', '.') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush
