@extends('auth::layouts.app')

@section('title', 'Register - Valorent')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-7">
                <!-- Register Card -->
                <div class="auth-card">
                    <div class="auth-card-header">
                        <h2 class="auth-title">REGISTER</h2>
                        <p class="auth-subtitle">Create your Valorent account</p>
                    </div>
                    <div class="auth-card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="name" class="form-label-custom">
                                            NAME <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control-custom @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}"
                                               placeholder="Enter your name"
                                               required 
                                               autofocus>
                                        @error('name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="email" class="form-label-custom">
                                            EMAIL <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control-custom @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}"
                                               placeholder="Enter your email"
                                               required>
                                        @error('email')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="password" class="form-label-custom">
                                            PASSWORD <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" 
                                               class="form-control-custom @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password"
                                               placeholder="Enter password"
                                               required>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="password_confirmation" class="form-label-custom">
                                            CONFIRM PASSWORD <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" 
                                               class="form-control-custom" 
                                               id="password_confirmation" 
                                               name="password_confirmation"
                                               placeholder="Confirm password"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="phone" class="form-label-custom">PHONE</label>
                                        <input type="text" 
                                               class="form-control-custom @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone') }}"
                                               placeholder="Enter phone number">
                                        @error('phone')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Birth Date -->
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="birth_date" class="form-label-custom">BIRTH DATE</label>
                                        <input type="date" 
                                               class="form-control-custom @error('birth_date') is-invalid @enderror" 
                                               id="birth_date" 
                                               name="birth_date" 
                                               value="{{ old('birth_date') }}">
                                        @error('birth_date')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group-custom">
                                <label for="address" class="form-label-custom">ADDRESS</label>
                                <textarea class="form-control-custom @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3"
                                          placeholder="Enter your address">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn-auth-primary">
                                <i class="bi bi-person-plus me-2"></i>REGISTER
                            </button>

                            <div class="auth-footer">
                                <p class="text-center">Already have an account? 
                                    <a href="{{ route('login') }}" class="auth-link">Login here</a>
                                </p>
                            </div>
                        </form>
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
        background: linear-gradient(135deg, #0a0e1a 0%, #1a2332 50%, #0f1923 100%);
        min-height: 100vh;
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }

    /* Auth Card */
    .auth-card {
        background: linear-gradient(180deg, #1a2332 0%, #151e2b 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .auth-card-header {
        padding: 2.5rem 2rem 1.5rem;
        background: linear-gradient(135deg, rgba(255, 68, 68, 0.1) 0%, transparent 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .auth-title {
        color: #fff;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #9ca3af;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .auth-card-body {
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

    /* Auth Button */
    .btn-auth-primary {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 68, 68, 0.4);
        margin-bottom: 1.5rem;
    }

    .btn-auth-primary:hover {
        background: linear-gradient(135deg, #ff6666 0%, #ff4444 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 68, 68, 0.6);
    }

    /* Auth Footer */
    .auth-footer {
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .auth-footer p {
        color: #9ca3af;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .auth-link {
        color: #ff4444;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .auth-link:hover {
        color: #ff6666;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .auth-card-header {
            padding: 2rem 1.5rem 1rem;
        }

        .auth-title {
            font-size: 1.75rem;
        }

        .auth-card-body {
            padding: 1.5rem;
        }
    }
</style>
@endpush