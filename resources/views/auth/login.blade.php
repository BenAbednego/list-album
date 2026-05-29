@extends('layouts.app')

@section('title', 'Sign In - Photo Album')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <svg class="logo-icon" viewBox="0 0 24 24" style="width: 64px; height: 64px; fill: var(--primary-yellow);">
                <path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/>
            </svg>
            <h2 class="auth-title">Photo Album</h2>
        </div>

        <div class="auth-tabs">
            <a href="{{ route('login') }}" class="auth-tab active" id="tab-login">Sign In</a>
            <a href="{{ route('register') }}" class="auth-tab" id="tab-register-link">Sign Up</a>
        </div>

        <form action="{{ route('login') }}" method="POST" class="auth-form" id="form-login">
            @csrf
            
            <div class="auth-input-group">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Username atau Email" class="auth-input" id="input-login-email" required autofocus>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-input-group">
                <input type="password" name="password" placeholder="Password" class="auth-input" id="input-login-password" required>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-auth-submit" id="btn-login-submit">Done</button>
        </form>

        <div class="auth-footer">
            <span>Belum punya akun? <a href="{{ route('register') }}" class="auth-link" id="link-goto-register">Daftar sekarang</a></span>
        </div>
    </div>
</div>
@endsection
