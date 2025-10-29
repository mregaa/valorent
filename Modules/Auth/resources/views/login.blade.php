@extends('auth::layouts.app')

@section('title', 'Login - Valorent')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5">
                <!-- Login Card -->
                <div class="auth-card">
                    <div class="auth-card-header">
                        <h2 class="auth-title">LOGIN</h2>
                        <p class="auth-subtitle">Welcome back to Valorent</p>
                    </div>
                    <div class="auth-card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="form-group-custom">
                                <label for="email" class="form-label-custom">EMAIL</label>
                                <input type="email" 
                                       class="form-control-custom @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Enter your email"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group-custom">
                                <label for="password" class="form-label-custom">PASSWORD</label>
                                <input type="password" 
                                       class="form-control-custom @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password"
                                       placeholder="Enter your password"
                                       required>
                                @error('password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check-custom">
                                <input type="checkbox" 
                                       class="form-check-input-custom" 
                                       id="remember" 
                                       name="remember">
                                <label class="form-check-label-custom" for="remember">
                                    Remember Me
                                </label>
                            </div>

                            <button type="submit" class="btn-auth-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>LOGIN
                            </button>

                            <div class="auth-footer">
                                <p class="text-center">Don't have an account? 
                                    <a href="{{ route('register') }}" class="auth-link">Register here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Demo Credentials -->
                <div class="demo-credentials-card">
                    <div class="demo-header">
                        <i class="bi bi-info-circle me-2"></i>Demo Credentials
                    </div>
                    <div class="demo-body">
                        <div class="demo-item">
                            <span class="demo-label">Admin:</span>
                            <span class="demo-value">admin@valorent.com / admin123</span>
                        </div>
                        <div class="demo-item">
                            <span class="demo-label">User:</span>
                            <span class="demo-value">user@valorent.com / user123</span>
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

    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Checkbox */
    .form-check-custom {
        margin-bottom: 1.5rem;
    }

    .form-check-input-custom {
        width: 18px;
        height: 18px;
        margin-right: 0.5rem;
        cursor: pointer;
    }

    .form-check-label-custom {
        color: #d1d5db;
        font-size: 0.9rem;
        cursor: pointer;
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

    /* Demo Credentials Card */
    .demo-credentials-card {
        margin-top: 1.5rem;
        background: linear-gradient(180deg, #1a2332 0%, #151e2b 100%);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .demo-header {
        padding: 0.875rem 1.25rem;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.1) 100%);
        border-bottom: 1px solid rgba(59, 130, 246, 0.3);
        color: #60a5fa;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.05em;
    }

    .demo-body {
        padding: 1.25rem;
    }

    .demo-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        margin-bottom: 0.75rem;
    }

    .demo-item:last-child {
        margin-bottom: 0;
    }

    .demo-label {
        color: #9ca3af;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .demo-value {
        color: #e5e7eb;
        font-size: 0.9rem;
        font-family: 'Courier New', monospace;
    }

    /* Responsive */
    @media (max-width: 576px) {
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