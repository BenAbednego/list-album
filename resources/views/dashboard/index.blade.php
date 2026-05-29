@extends('layouts.app')

@section('title', 'Dashboard - Photo Album')

@section('content')
<div class="app-container">
    
    <!-- Top Header Bar -->
    <header class="header-bar">
        <h1 class="header-title" id="header-page-title">Home</h1>
        <div class="header-actions">
            <span style="font-weight: 600; font-size: 0.95rem; opacity: 0.8;">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="logout-form" id="form-logout">
                @csrf
                <button type="submit" id="btn-logout">Logout</button>
            </form>
        </div>
    </header>

    <!-- Sidebar Area -->
    <aside class="sidebar">
        <div class="sidebar-top">
            <!-- Logo Section -->
            <div class="logo-container" id="sidebar-logo">
                <!-- Camera / Photo Album SVG Icon -->
                <svg class="logo-icon" viewBox="0 0 24 24">
                    <path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/>
                </svg>
                <span class="logo-text">Photo<br>Album</span>
            </div>

            <!-- Albums Menu List -->
            <nav class="album-menu" id="album-list">
                @foreach($albums as $album)
                    <div class="album-item-wrapper" style="position: relative; width: 100%;">
                        <a href="{{ route('dashboard', ['album_id' => $album->id]) }}" 
                           class="album-item {{ $activeAlbum && $activeAlbum->id === $album->id ? 'active' : '' }}"
                           id="album-item-{{ $album->id }}">
                            <span class="album-item-left">{{ $album->name }}</span>
                            
                            <span class="album-item-actions">
                                <!-- Rename Album -->
                                <button type="button" class="album-action-btn edit-album-btn" 
                                        onclick="event.preventDefault(); renameAlbum({{ $album->id }}, '{{ addslashes($album->name) }}')"
                                        title="Ubah Nama Album" id="btn-rename-album-{{ $album->id }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                        <path d="M12 20h9M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                    </svg>
                                </button>
                                <!-- Delete Album -->
                                <button type="button" class="album-action-btn delete-album-btn" 
                                        onclick="event.preventDefault(); deleteAlbum({{ $album->id }})"
                                        title="Hapus Album" id="btn-delete-album-{{ $album->id }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px; color: red;">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                    </svg>
                                </button>
                            </span>
                        </a>
                    </div>
                @endforeach
            </nav>
        </div>

        <!-- Add Album Sidebar Interaction -->
        <div class="add-album-container">
            <!-- Inline Form (Initially hidden) -->
            <form id="add-album-form" class="inline-add-album-form" style="display: none;">
                @csrf
                <div class="album-input-wrapper">
                    <input type="text" name="name" placeholder="Title" class="inline-album-input" id="input-new-album-name" required autocomplete="off">
                    <button type="button" class="btn-cancel-album" onclick="hideAddAlbumForm()" id="btn-cancel-new-album">✕</button>
                </div>
                <button type="submit" class="btn-done-album" id="btn-submit-new-album">Done</button>
            </form>

            <!-- Add Plus Button -->
            <button type="button" class="btn-add-album-trigger" onclick="showAddAlbumForm()" id="btn-add-album-trigger">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
            </button>
        </div>
    </aside>

    <!-- Main Grid Content Area -->
    <main class="main-content">
        <!-- Search bar & Add photo trigger -->
        <div class="action-row">
            @if($activeAlbum)
                <div class="search-container">
                    <div class="search-icon-wrapper">
                        <svg class="search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="11" cy="11" r="8" stroke-width="2.5"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2.5"/>
                        </svg>
                    </div>
                    <input type="text" id="search-photos-input" placeholder="Search" class="search-input" autocomplete="off">
                </div>

                <a href="{{ route('photos.create', ['album_id' => $activeAlbum->id]) }}" class="btn-add-photo" title="Tambah Foto" id="btn-add-photo-trigger">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                </a>
            @else
                <div class="empty-state" style="margin: auto;">
                    <h3 style="color: var(--text-dark);">Belum ada album</h3>
                    <p style="color: var(--text-dark); opacity: 0.8;">Klik tombol + di bawah sidebar untuk membuat album pertamamu.</p>
                </div>
            @endif
        </div>

        <!-- Photos Grid container -->
        <div class="photos-grid" id="photos-grid-container">
            @if($activeAlbum)
                @include('dashboard.partials.photos-grid', ['activeAlbum' => $activeAlbum, 'photos' => $photos])
            @endif
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    // Show & Hide Add Album form inline
    function showAddAlbumForm() {
        document.getElementById('btn-add-album-trigger').style.display = 'none';
        const form = document.getElementById('add-album-form');
        form.style.display = 'flex';
        document.getElementById('input-new-album-name').focus();
    }

    function hideAddAlbumForm() {
        document.getElementById('add-album-form').style.display = 'none';
        document.getElementById('btn-add-album-trigger').style.display = 'flex';
        document.getElementById('input-new-album-name').value = '';
    }

    // Ajax Create Album
    document.getElementById('add-album-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const nameInput = document.getElementById('input-new-album-name');
        const name = nameInput.value.trim();
        if (!name) return;

        fetch('{{ route("albums.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ name: name })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to newly created album dashboard
                window.location.href = data.redirect_url;
            }
        })
        .catch(err => console.error(err));
    });

    // Rename Album
    function renameAlbum(id, currentName) {
        const newName = prompt('Masukkan nama album baru:', currentName);
        if (newName === null) return;
        const trimmed = newName.trim();
        if (!trimmed || trimmed === currentName) return;

        fetch(`/albums/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ name: trimmed })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update text inline
                const albumLink = document.querySelector(`#album-item-${id} .album-item-left`);
                if (albumLink) albumLink.textContent = trimmed;
                // Update rename button parameter
                const renameBtn = document.getElementById(`btn-rename-album-${id}`);
                if (renameBtn) {
                    renameBtn.setAttribute('onclick', `event.preventDefault(); renameAlbum(${id}, '${trimmed.replace(/'/g, "\\'")}')`);
                }
            }
        })
        .catch(err => console.error(err));
    }

    // Delete Album
    function deleteAlbum(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus album ini beserta semua foto di dalamnya?')) return;

        fetch(`/albums/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect_url;
            }
        })
        .catch(err => console.error(err));
    }

    // AJAX Search
    @if($activeAlbum)
        const searchInput = document.getElementById('search-photos-input');
        let searchTimeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value;

            // Debounce for 300ms
            searchTimeout = setTimeout(() => {
                const url = new URL('{{ route("dashboard") }}', window.location.origin);
                url.searchParams.set('album_id', '{{ $activeAlbum->id }}');
                if (query.trim()) {
                    url.searchParams.set('search', query.trim());
                }

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('photos-grid-container').innerHTML = data.html;
                })
                .catch(err => console.error(err));
            }, 300);
        });
    @endif
</script>
@endsection
