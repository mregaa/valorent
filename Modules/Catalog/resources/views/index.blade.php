@extends('auth::layouts.app')

@section('title', 'Catalog - Valorent')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Catalog Akun Valorant</h2>
            <p class="text-muted">Pilih akun Valorant yang ingin Anda sewa</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        <div class="row g-3">
                            <!-- Search -->
                            <div class="col-md-6">
                                <label for="search" class="form-label">Search by Name</label>
                                <input type="text" class="form-control" id="search" name="search" 
                                       placeholder="Search unit name..." value="{{ $search ?? '' }}">
                            </div>

                            <!-- Filter by Category -->
                            <div class="col-md-4">
                                <label for="category" class="form-label">Filter by Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ ($categoryId == $category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    @if($search || $categoryId)
                        <div class="mt-3">
                            <a href="{{ route('catalog.index') }}" class="btn btn-sm btn-outline-secondary">
                                Clear Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Units Grid -->
    <div class="row">
        @forelse($units as $unit)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- Unit Image Placeholder -->
                    <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        @if($unit->image)
                            <img src="{{ asset('storage/' . $unit->image) }}" alt="{{ $unit->name }}" 
                                 class="img-fluid" style="max-height: 200px; object-fit: cover;">
                        @else
                            <i class="bi bi-controller" style="font-size: 4rem;"></i>
                        @endif
                    </div>

                    <div class="card-body">
                        <!-- Unit Code -->
                        <span class="badge bg-info text-dark mb-2">{{ $unit->code }}</span>

                        <!-- Unit Name -->
                        <h5 class="card-title">{{ $unit->name }}</h5>

                        <!-- Unit Rank & Level -->
                        <p class="card-text">
                            <strong>Rank:</strong> {{ $unit->rank }}<br>
                            <strong>Level:</strong> {{ $unit->level }}
                        </p>

                        <!-- Categories -->
                        <div class="mb-2">
                            @foreach($unit->categories as $category)
                                <span class="badge bg-secondary">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <!-- Price -->
                        <h5 class="text-primary">Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}/day</h5>

                        <!-- Status -->
                        @if($unit->status === 'available')
                            <span class="badge bg-success">Available</span>
                        @elseif($unit->status === 'rented')
                            <span class="badge bg-danger">Rented</span>
                        @else
                            <span class="badge bg-warning">Maintenance</span>
                        @endif
                    </div>

                    <div class="card-footer bg-transparent">
                        <a href="{{ route('catalog.show', $unit->id) }}" class="btn btn-outline-primary w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <h5>No units found</h5>
                    <p>Try adjusting your search or filter criteria.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush
