@extends('auth::layouts.app')

@section('title', $unit->name . ' - Valorent')

@section('content')
<div class="container">
    <div class="row">
        <!-- Back Button -->
        <div class="col-md-12 mb-3">
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Catalog
            </a>
        </div>

        <!-- Unit Image -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center bg-secondary text-white" style="min-height: 400px;">
                    @if($unit->image)
                        <img src="{{ asset('storage/' . $unit->image) }}" alt="{{ $unit->name }}" 
                             class="img-fluid" style="max-height: 400px; object-fit: contain;">
                    @else
                        <i class="bi bi-controller" style="font-size: 8rem;"></i>
                        <p class="mt-3">No image available</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Unit Details -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Unit Code -->
                    <span class="badge bg-info text-dark mb-2">{{ $unit->code }}</span>

                    <!-- Unit Name -->
                    <h2 class="card-title">{{ $unit->name }}</h2>

                    <!-- Status -->
                    @if($unit->status === 'available')
                        <span class="badge bg-success mb-3">Available</span>
                    @elseif($unit->status === 'rented')
                        <span class="badge bg-danger mb-3">Currently Rented</span>
                    @else
                        <span class="badge bg-warning mb-3">Under Maintenance</span>
                    @endif

                    <!-- Price -->
                    <h3 class="text-primary mb-3">
                        Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}/day
                    </h3>

                    <!-- Description -->
                    <div class="mb-3">
                        <h5>Description</h5>
                        <p>{{ $unit->description ?? 'No description available.' }}</p>
                    </div>

                    <!-- Details -->
                    <div class="mb-3">
                        <h5>Details</h5>
                        <table class="table table-sm">
                            <tr>
                                <th width="30%">Rank:</th>
                                <td>{{ $unit->rank }}</td>
                            </tr>
                            <tr>
                                <th>Level:</th>
                                <td>{{ $unit->level }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($unit->status === 'available')
                                        <span class="text-success">Available for rent</span>
                                    @elseif($unit->status === 'rented')
                                        <span class="text-danger">Currently rented</span>
                                    @else
                                        <span class="text-warning">Under maintenance</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Categories -->
                    <div class="mb-3">
                        <h5>Categories</h5>
                        @foreach($unit->categories as $category)
                            <span class="badge bg-secondary me-1">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    <!-- Rent Button -->
                    @auth
                        @if($unit->status === 'available')
                            <a href="{{ route('rental.create', $unit->id) }}" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-cart-plus"></i> Rent Now
                            </a>
                        @else
                            <button class="btn btn-secondary btn-lg w-100" disabled>
                                Not Available
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg w-100">
                            <i class="bi bi-lock"></i> Login to Rent
                        </a>
                    @endauth

                    <!-- Info -->
                    <div class="alert alert-info mt-3">
                        <small>
                            <i class="bi bi-info-circle"></i> 
                            Maximum rental period: 5 days. Late returns will incur a 10% daily fine.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush
