@extends('auth::layouts.app')

@section('title', 'My Profile - Valorent')

@section('content')
<div class="container-fluid px-md-5 py-5" style="background-color: #0f1923; max-width: 1920px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="text-white fw-bold" style="font-size: 2.5rem; letter-spacing: 0.1em;">MY PROFILE</h2>
            <p class="text-muted">Manage your account information</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Profile Information Card -->
            <div class="profile-card mb-4">
                <div class="profile-card-header">
                    <div class="d-flex align-items-center">
                        <div class="profile-icon-wrapper bg-primary">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div>
                            <h5 class="profile-card-title">PROFILE INFORMATION</h5>
                            <p class="profile-card-subtitle">Update your personal details</p>
                        </div>
                    </div>
                </div>
                <div class="profile-card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="name" class="form-label-custom">NAME</label>
                                    <input type="text" 
                                           class="form-control-custom @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="Enter your name"
                                           required>
                                    @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="email" class="form-label-custom">EMAIL</label>
                                    <input type="email" 
                                           class="form-control-custom @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="Enter your email"
                                           required>
                                    @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="phone" class="form-label-custom">PHONE</label>
                                    <input type="text" 
                                           class="form-control-custom @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', $user->profile->phone ?? '') }}"
                                           placeholder="Enter phone number">
                                    @error('phone')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="birth_date" class="form-label-custom">BIRTH DATE</label>
                                    <input type="date" 
                                           class="form-control-custom @error('birth_date') is-invalid @enderror" 
                                           id="birth_date" 
                                           name="birth_date" 
                                           value="{{ old('birth_date', $user->profile->birth_date?->format('Y-m-d') ?? '') }}">
                                    @error('birth_date')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="address" class="form-label-custom">ADDRESS</label>
                            <textarea class="form-control-custom @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3"
                                      placeholder="Enter your address">{{ old('address', $user->profile->address ?? '') }}</textarea>
                            @error('address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-profile-primary">
                            <i class="bi bi-check-circle me-2"></i>UPDATE PROFILE
                        </button>
                    </form>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="d-flex align-items-center">
                        <div class="profile-icon-wrapper bg-warning">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div>
                            <h5 class="profile-card-title">CHANGE PASSWORD</h5>
                            <p class="profile-card-subtitle">Update your password to keep your account secure</p>
                        </div>
                    </div>
                </div>
                <div class="profile-card-body">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group-custom">
                            <label for="current_password" class="form-label-custom">CURRENT PASSWORD</label>
                            <input type="password" 
                                   class="form-control-custom @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password"
                                   placeholder="Enter current password"
                                   required>
                            @error('current_password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="password" class="form-label-custom">NEW PASSWORD</label>
                                    <input type="password" 
                                           class="form-control-custom @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password"
                                           placeholder="Enter new password"
                                           required>
                                    @error('password')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="password_confirmation" class="form-label-custom">CONFIRM NEW PASSWORD</label>
                                    <input type="password" 
                                           class="form-control-custom" 
                                           id="password_confirmation" 
                                           name="password_confirmation"
                                           placeholder="Confirm new password"
                                           required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-profile-warning">
                            <i class="bi bi-key me-2"></i>CHANGE PASSWORD
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

    /* Profile Card */
    .profile-card {
        background: linear-gradient(180deg, #1a2332 0%, #151e2b 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .profile-card-header {
        padding: 2rem;
        background: linear-gradient(135deg, rgba(255, 68, 68, 0.05) 0%, transparent 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .profile-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: white;
        margin-right: 1rem;
    }

    .profile-card-title {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 0.25rem;
    }

    .profile-card-subtitle {
        color: #9ca3af;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .profile-card-body {
        padding: 2rem;
    }

    /* Form Groups */
    .form-group-custom {
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        display: block;
        color: #9ca3af;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.875rem 1rem;
        background: rgba(15, 25, 35, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        color: #fff;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        background: rgba(15, 25, 35, 0.8);
        border-color: #ff4444;
        box-shadow: 0 0 0 3px rgba(255, 68, 68, 0.1);
    }

    .form-control-custom::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .form-control-custom.is-invalid {
        border-color: #ef4444;
    }

    textarea.form-control-custom {
        resize: vertical;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Profile Buttons */
    .btn-profile-primary {
        display: inline-flex;
        align-items: center;
        padding: 0.875rem 2rem;
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 68, 68, 0.4);
    }

    .btn-profile-primary:hover {
        background: linear-gradient(135deg, #ff6666 0%, #ff4444 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 68, 68, 0.6);
    }

    .btn-profile-warning {
        display: inline-flex;
        align-items: center;
        padding: 0.875rem 2rem;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }

    .btn-profile-warning:hover {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-card-header {
            padding: 1.5rem;
        }

        .profile-card-body {
            padding: 1.5rem;
        }

        .profile-icon-wrapper {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .profile-card-title {
            font-size: 1.1rem;
        }
    }
</style>
@endpush