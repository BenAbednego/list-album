@extends('layouts.app')

@section('title', 'Zoom Foto - Photo Album')

@section('content')
<div class="app-container">
    
    <!-- Top Header Bar -->
    <header class="header-bar">
        <h1 class="header-title">Zoom</h1>
        <div class="header-actions">
            <span style="font-weight: 600; font-size: 0.95rem; opacity: 0.8;">{{ Auth::user()->name }}</span>
        </div>
    </header>

    <!-- Sidebar Area (Same as Dashboard) -->
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="logo-container">
                <svg class="logo-icon" viewBox="0 0 24 24">
                    <path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/>
                </svg>
                <span class="logo-text">Photo<br>Album</span>
            </div>

            <nav class="album-menu">
                @foreach($albums as $item)
                    <a href="{{ route('dashboard', ['album_id' => $item->id]) }}" 
                       class="album-item {{ $album->id === $item->id ? 'active' : '' }}"
                       id="sidebar-album-{{ $item->id }}">
                        <span class="album-item-left">{{ $item->name }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
        
        <div class="add-album-container" style="text-align: center;">
            <a href="{{ route('dashboard') }}" class="btn-add-album-trigger" title="Kembali ke Dashboard" id="btn-back-dashboard-sidebar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="transform: rotate(45deg);">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
            </a>
        </div>
    </aside>

    <!-- Main Zoom Area -->
    <main class="main-content">
        <div class="zoom-container">
            <!-- Back button in the top left corner of the main panel -->
            <div class="zoom-header">
                <a href="{{ route('dashboard', ['album_id' => $album->id]) }}" class="btn-back" title="Kembali" id="btn-back-zoom">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </a>
                <h2 style="margin-left: 20px; font-weight: 800; color: var(--text-dark);">{{ $photo->title }}</h2>
            </div>

            <!-- Zoom Card Wrapper -->
            <div class="zoom-card">
                <!-- Large Image (with dark borders as in mockup) -->
                <div class="zoom-image-wrapper">
                    <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}" class="zoom-image">
                </div>

                <!-- Details (white box below image) -->
                <div class="zoom-details">
                    <div class="zoom-row">
                        <div class="zoom-description">
                            <strong>Deskripsi:</strong><br>
                            {{ $photo->description ?? 'Tidak ada deskripsi.' }}
                        </div>
                        <div class="zoom-date">
                            <strong>Date:</strong><br>
                            {{ \Carbon\Carbon::parse($photo->date)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
