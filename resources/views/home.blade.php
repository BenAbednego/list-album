@extends('layouts.app')

@title('Selamat Datang - Photo Album')

@section('content')
<div class="auth-wrapper">
    <div class="landing-container">
        <div class="landing-card">
            <div class="logo-container" style="background: none; margin-bottom: 0;">
                <svg class="logo-icon" viewBox="0 0 24 24" style="width: 80px; height: 80px; fill: var(--primary-yellow);">
                    <path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/>
                </svg>
            </div>
            <h1 class="landing-title">Photo Album</h1>
            <p class="landing-desc">
                Simpan dan kelola foto kenangan indah Anda di dalam album privat secara aman. Hanya Anda yang dapat melihat dan mengatur seluruh koleksi foto Anda.
            </p>
            <div class="landing-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary" id="btn-landing-login">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-dark" id="btn-landing-register">Sign Up</a>
            </div>
        </div>
    </div>
</div>
@endsection
