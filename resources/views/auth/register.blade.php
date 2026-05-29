@extends('layouts.app')

@section('title', 'Sign Up - Photo Album')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="auth-title">SignUp</h2>
        </div>

        <form action="{{ route('register') }}" method="POST" class="auth-form" id="form-register">
            @csrf

            <div class="auth-input-group">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="auth-input" id="input-register-email" required>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-input-group">
                <input type="password" name="password" placeholder="Create Password" class="auth-input" id="input-register-password" required>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-input-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="auth-input" id="input-register-password-conf" required>
            </div>

            <button type="submit" class="btn-auth-submit" id="btn-register-submit" style="background-color: #8b6e8a; color: white;">Signup</button>
        </form>

        <div class="auth-footer">
            <span>Already have an account? <a href="{{ route('login') }}" class="auth-link" id="link-goto-login">Login</a></span>
            
            <div class="social-divider">Or</div>

            <!-- Social Login Mock Buttons -->
            <button class="btn-social btn-facebook" onclick="alert('Login Facebook hanya simulasi.')" id="btn-social-fb">
                <!-- Simple mock Facebook logo using SVG -->
                <svg class="social-logo" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Login with Facebook
            </button>

            <button class="btn-social btn-google" onclick="alert('Login Google hanya simulasi.')" id="btn-social-google">
                <!-- Simple mock Google logo using SVG -->
                <svg class="social-logo" viewBox="0 0 24 24">
                    <path fill="#EA4335" d="M12 5.04c1.67 0 3.2.58 4.38 1.71l3.27-3.27C17.67 1.63 14.99 1 12 1 7.35 1 3.39 3.65 1.5 7.5l3.87 3C6.31 7.57 8.95 5.04 12 5.04z"/>
                    <path fill="#4285F4" d="M23.49 12.27c0-.81-.07-1.59-.2-2.34H12v4.43h6.45c-.28 1.48-1.12 2.74-2.38 3.58l3.69 2.87c2.16-1.99 3.73-4.92 3.73-8.54z"/>
                    <path fill="#FBBC05" d="M5.37 14.5c-.24-.71-.37-1.47-.37-2.5s.13-1.79.37-2.5L1.5 6.5C.54 8.42 0 10.58 0 13s.54 4.58 1.5 6.5l3.87-3z"/>
                    <path fill="#34A853" d="M12 23c3.24 0 5.97-1.07 7.96-2.91l-3.69-2.87c-1.02.68-2.33 1.09-4.27 1.09-3.05 0-5.69-2.53-6.63-5.46L1.5 15.85C3.39 19.7 7.35 22.35 12 22.35z"/>
                </svg>
                Login with Google
            </button>
        </div>
    </div>
</div>
@endsection
