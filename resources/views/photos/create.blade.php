@extends('layouts.app')

@section('title', 'Tambah Foto - Photo Album')

@section('content')
<div class="app-container">
    
    <!-- Top Header Bar -->
    <header class="header-bar">
        <h1 class="header-title">Add_Photo</h1>
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
                @foreach($albums as $album)
                    <a href="{{ route('dashboard', ['album_id' => $album->id]) }}" 
                       class="album-item {{ $activeAlbum && $activeAlbum->id === $album->id ? 'active' : '' }}"
                       id="sidebar-album-{{ $album->id }}">
                        <span class="album-item-left">{{ $album->name }}</span>
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

    <!-- Main Form Area -->
    <main class="main-content">
        <!-- Top Back button -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <a href="{{ route('dashboard', ['album_id' => $activeAlbum->id]) }}" class="btn-back" title="Kembali" id="btn-back-header">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </a>
        </div>

        <!-- Form Box -->
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="form-container" id="form-add-photo">
            @csrf
            <input type="hidden" name="album_id" value="{{ $activeAlbum->id }}">

            <!-- Title -->
            <div class="form-group">
                <label for="input-title">Add Title</label>
                <input type="text" name="title" id="input-title" value="{{ old('title') }}" class="form-input" required>
                @error('title')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Date -->
            <div class="form-group">
                <label for="input-date">Add Date</label>
                <!-- Default to today's date formatted for input -->
                <input type="date" name="date" id="input-date" value="{{ old('date', date('Y-m-d')) }}" class="form-input" required>
                @error('date')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="input-description">Add Description</label>
                <textarea name="description" id="input-description" class="form-input">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Photo Upload -->
            <div class="form-group">
                <label>Add Photo</label>
                <div class="photo-upload-box" id="upload-box">
                    <input type="file" name="photo" id="input-photo" accept="image/*" required>
                    
                    <!-- SVG Image Icon (matching mockup icon) -->
                    <svg class="upload-icon" id="upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    
                    <span class="upload-text" id="upload-text">Klik atau seret file gambar ke sini</span>
                    
                    <!-- Preview Image -->
                    <img id="preview-img" class="file-preview" src="#" alt="Preview Foto">
                </div>
                @error('photo')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Done/Submit checkmark Button (matching mockup bottom right checkmark button) -->
            <div class="form-footer">
                <button type="submit" class="btn-submit-form" title="Simpan Foto" id="btn-submit-photo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </button>
            </div>
        </form>
    </main>
</div>
@endsection

@section('scripts')
<script>
    // Live preview for selected image file
    const photoInput = document.getElementById('input-photo');
    const previewImg = document.getElementById('preview-img');
    const uploadIcon = document.getElementById('upload-icon');
    const uploadText = document.getElementById('upload-text');

    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                uploadIcon.style.display = 'none';
                uploadText.style.display = 'none';
            }
            reader.readAsDataURL(file);
        } else {
            previewImg.style.display = 'none';
            uploadIcon.style.display = 'block';
            uploadText.style.display = 'block';
        }
    });
</script>
@endsection
