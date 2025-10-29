@extends('auth::layouts.app')

@section('title', $unit->name . ' - Valorent')

@section('content')
<div class="container-fluid px-4 py-5" style="background-color: #0f1923; min-height: 100vh;">
    <!-- Back Button -->
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-light">
                <i class="bi bi-arrow-left me-2"></i> Back to Catalog
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Unit Image -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center bg-secondary text-white" style="min-height: 400px;">
                    @if($unit->image)
                        <img src="{{ asset('storage/' . $unit->image) }}" alt="{{ $unit->name }}" 
                             class="img-fluid" style="max-height: 400px; object-fit: contain;">
                    @else
                        <span class="badge-large bg-warning">
                            <i class="bi bi-tools me-2"></i>MAINTENANCE
                        </span>
                    @endif
                </div>
                
                <!-- Unit Code on Image -->
                <div class="position-absolute bottom-0 start-0 m-4">
                    <div class="code-badge">{{ $unit->code }}</div>
                </div>
            </div>
        </div>

        <!-- Unit Details -->
        <div class="col-lg-6">
            <div class="unit-detail-card">
                <div class="detail-content">
                    <!-- Unit Name -->
                    <h1 class="unit-title text-white mb-3">{{ strtoupper($unit->name) }}</h1>
                    
                    <!-- Categories -->
                    <div class="mb-4">
                        @foreach($unit->categories as $category)
                            <span class="badge bg-secondary bg-opacity-50 me-2 px-3 py-2">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    <!-- Price Card -->
                    <div class="price-card mb-4">
                        <div class="price-label text-white-50">RENTAL PRICE</div>
                        <h2 class="price-value text-danger mb-0">
                            Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}
                            <span class="price-period">/day</span>
                        </h2>
                    </div>

                    <!-- Stats Grid -->
                    <div class="stats-grid mb-4">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-trophy-fill text-warning"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">Rank</div>
                                <div class="stat-value">{{ $unit->rank }}</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-star-fill text-info"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">Level</div>
                                <div class="stat-value">{{ $unit->level }}</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-shield-fill text-success"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">Status</div>
                                <div class="stat-value">
                                    @if($unit->status === 'available')
                                        Available
                                    @elseif($unit->status === 'rented')
                                        Rented
                                    @else
                                        Maintenance
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($unit->description)
                    <div class="description-section mb-4">
                        <h5 class="section-title text-white mb-3">
                            <i class="bi bi-file-text me-2"></i>DESCRIPTION
                        </h5>
                        <p class="text-white-50">{{ $unit->description }}</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="action-section">
                        @auth
                            @if($unit->status === 'available')
                                <a href="{{ route('rental.create', $unit->id) }}" class="btn-rent w-100">
                                    <i class="bi bi-cart-plus me-2"></i>RENT NOW
                                </a>
                            @else
                                <button class="btn-disabled w-100" disabled>
                                    <i class="bi bi-x-circle me-2"></i>NOT AVAILABLE
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-login w-100">
                                <i class="bi bi-lock me-2"></i>LOGIN TO RENT
                            </a>
                        @endauth

                        <!-- Info Alert -->
                        <div class="info-alert mt-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle-fill text-info me-3 mt-1"></i>
                                <div class="text-white-50 small">
                                    <strong class="text-white">Rental Information:</strong><br>
                                    Maximum rental period is 5 days. Late returns will incur a 10% daily fine.
                                </div>
                            </div>
                        </div>
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
    
    /* Image Card Styles */
    .unit-detail-image-card {
        background: linear-gradient(135deg, #1e3a5f 0%, #2d1b3d 100%);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        min-height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .unit-detail-image {
        height: 600px;
        object-fit: cover;
        object-position: center;
    }
    
    .unit-detail-placeholder {
        height: 600px;
        width: 100%;
        background: linear-gradient(135deg, #1e3a5f 0%, #2d1b3d 100%);
    }
    
    .image-glow {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: linear-gradient(to top, rgba(255, 68, 68, 0.3) 0%, transparent 100%);
        pointer-events: none;
    }
    
    .badge-large {
        font-size: 0.9rem;
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        letter-spacing: 0.1em;
        border-radius: 4px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }
    
    .code-badge {
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        border-radius: 4px;
        border: 2px solid rgba(255, 68, 68, 0.5);
        backdrop-filter: blur(10px);
    }
    
    /* Detail Card Styles */
    .unit-detail-card {
        background: linear-gradient(180deg, #1a2332 0%, #0f1923 100%);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 3rem;
        min-height: 600px;
    }
    
    .unit-title {
        font-size: 3rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-shadow: 2px 2px 8px rgba(255, 68, 68, 0.3);
        line-height: 1.2;
    }
    
    /* Price Card */
    .price-card {
        background: rgba(255, 68, 68, 0.1);
        border: 2px solid rgba(255, 68, 68, 0.3);
        border-radius: 8px;
        padding: 1.5rem;
    }
    
    .price-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        margin-bottom: 0.5rem;
    }
    
    .price-value {
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }
    
    .price-period {
        font-size: 1.2rem;
        color: #9ca3af;
        font-weight: 400;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    .stat-item {
        background: rgba(26, 35, 50, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        background: rgba(26, 35, 50, 1);
        border-color: rgba(255, 68, 68, 0.3);
        transform: translateY(-2px);
    }
    
    .stat-icon {
        font-size: 1.75rem;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.25rem;
    }
    
    .stat-value {
        font-size: 1.1rem;
        color: #fff;
        font-weight: 600;
    }
    
    /* Description Section */
    .description-section {
        background: rgba(26, 35, 50, 0.5);
        border-left: 4px solid #ff4444;
        border-radius: 4px;
        padding: 1.5rem;
    }
    
    .section-title {
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
    }
    
    /* Action Buttons */
    .btn-rent {
        display: block;
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 1.25rem;
        border: none;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 68, 68, 0.4);
    }
    
    .btn-rent:hover {
        background: linear-gradient(135deg, #ff6666 0%, #ff4444 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 68, 68, 0.6);
        color: white;
    }
    
    .btn-disabled {
        display: block;
        background: #374151;
        color: #6b7280;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 1.25rem;
        border: 1px solid #4b5563;
        border-radius: 8px;
        text-align: center;
        cursor: not-allowed;
    }
    
    .btn-login {
        display: block;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #000;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 1.25rem;
        border: none;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
    }
    
    .btn-login:hover {
        background: linear-gradient(135deg, #fcd34d 0%, #fbbf24 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(251, 191, 36, 0.6);
        color: #000;
    }
    
    /* Info Alert */
    .info-alert {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 8px;
        padding: 1rem;
    }
    
    /* Back Button */
    .btn-outline-light {
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-outline-light:hover {
        background-color: #ff4444;
        border-color: #ff4444;
        color: white;
        transform: translateX(-5px);
    }
    
    /* Responsive Design */
    @media (max-width: 991px) {
        .unit-title {
            font-size: 2rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .unit-detail-card {
            padding: 2rem;
        }
    }
    
    @media (max-width: 575px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .unit-title {
            font-size: 1.75rem;
        }
        
        .price-value {
            font-size: 2rem;
        }
    }
</style>
@endpush