@extends('auth::layouts.app')

@section('title', 'Catalog - Valorent')

@section('content')
<div class="container-fluid px-md-5 py-5" style="background-color: #0f1923; max-width: 1920px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="text-white fw-bold" style="font-size: 3rem; letter-spacing: 0.1em;">Catalog</h2>
            <p class="text-white-50">Pilih akun Valorant yang ingin Anda sewa</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card bg-dark border-0 shadow-lg">
                <div class="card-body p-4">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        <div class="row g-3">
                            <!-- Search -->
                            <div class="col-md-6">
                                <label for="search" class="form-label text-white">Search by Name</label>
                                <input type="text" class="form-control bg-secondary text-white border-0" id="search" name="search" 
                                       placeholder="Search unit name..." value="{{ $search ?? '' }}">
                            </div>

                            <!-- Filter by Category -->
                            <div class="col-md-4">
                                <label for="category" class="form-label text-white">Filter by Category</label>
                                <select class="form-select bg-secondary text-white border-0" id="category" name="category">
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
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    @if($search || $categoryId)
                        <div class="mt-3">
                            <a href="{{ route('catalog.index') }}" class="btn btn-sm btn-outline-light">
                                Clear Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Units Grid -->
    <div class="row g-4">
        @forelse($units as $unit)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="unit-card position-relative h-100">
                    <!-- Unit Image -->
                    <div class="unit-image-container position-relative overflow-hidden">
                        @if($unit->image)
                            <img src="{{ asset('storage/' . $unit->image) }}" alt="{{ $unit->name }}" 
                                 class="unit-image w-100">
                        @else
                            <div class="unit-placeholder bg-gradient d-flex align-items-center justify-content-center">
                                <i class="bi bi-controller text-white" style="font-size: 5rem; opacity: 0.3;"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay gradient -->
                        <div class="unit-overlay"></div>
                        
                        <!-- Status Badge -->
                        <div class="position-absolute top-0 end-0 m-3">
                            @if($unit->status === 'available')
                                <span class="badge bg-success px-3 py-2">Available</span>
                            @elseif($unit->status === 'rented')
                                <span class="badge bg-danger px-3 py-2">Rented</span>
                            @else
                                <span class="badge bg-warning px-3 py-2">Maintenance</span>
                            @endif
                        </div>
                        
                        <!-- Unit Code Badge -->
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-dark bg-opacity-75 px-3 py-2">{{ $unit->code }}</span>
                        </div>
                    </div>

                    <!-- Unit Info Footer -->
                    <div class="unit-footer">
                        <!-- Unit Name -->
                        <h5 class="unit-name text-white fw-bold mb-2">{{ strtoupper($unit->name) }}</h5>
                        
                        <!-- Categories -->
                        <div class="mb-2">
                            @foreach($unit->categories as $category)
                                <span class="badge bg-secondary bg-opacity-50 me-1">{{ $category->name }}</span>
                            @endforeach
                        </div>
                        
                        <!-- Rank & Level -->
                        <div class="text-white-50 small mb-2">
                            <span class="me-3"><i class="bi bi-trophy-fill text-warning me-1"></i> {{ $unit->rank }}</span>
                            <span><i class="bi bi-star-fill text-info me-1"></i> Level {{ $unit->level }}</span>
                        </div>

                        <!-- Price & Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-white-50 small">Price per day</div>
                                <h5 class="text-danger fw-bold mb-0">Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}</h5>
                            </div>
                            <a href="{{ route('catalog.show', $unit->id) }}" class="btn btn-outline-light btn-sm px-3">
                                Details <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-dark text-center border-secondary">
                    <h5 class="text-white">No units found</h5>
                    <p class="text-white-50">Try adjusting your search or filter criteria.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    body {
        background-color: #0f1923;
    }
    
    .unit-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border-radius: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .unit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(255, 68, 68, 0.3);
        border-color: rgba(255, 68, 68, 0.5);
    }
    
    .unit-image-container {
        height: 400px;
        position: relative;
        background: linear-gradient(135deg, #1e3a5f 0%, #2d1b3d 100%);
    }
    
    .unit-image {
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    
    .unit-placeholder {
        height: 400px;
        background: linear-gradient(135deg, #1e3a5f 0%, #2d1b3d 100%);
    }
    
    .unit-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 150px;
        background: linear-gradient(to top, rgba(15, 25, 35, 1) 0%, rgba(15, 25, 35, 0) 100%);
        pointer-events: none;
    }
    
    .unit-footer {
        padding: 1.5rem;
        background-color: rgba(26, 35, 50, 0.8);
        backdrop-filter: blur(10px);
    }
    
    .unit-name {
        font-size: 1.5rem;
        letter-spacing: 0.05em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .form-control:focus,
    .form-select:focus {
        background-color: #374151;
        border-color: #ff4444;
        box-shadow: 0 0 0 0.2rem rgba(255, 68, 68, 0.25);
        color: white;
    }
    
    .btn-danger {
        background-color: #ff4444;
        border-color: #ff4444;
    }
    
    .btn-danger:hover {
        background-color: #ff6666;
        border-color: #ff6666;
    }
    
    .btn-outline-light:hover {
        background-color: #ff4444;
        border-color: #ff4444;
    }
</style>
@endpush