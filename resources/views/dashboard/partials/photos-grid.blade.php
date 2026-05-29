@if($photos->count() > 0)
    @foreach($photos as $photo)
        <div class="photo-card" id="photo-card-{{ $photo->id }}">
            <!-- Zoom Button (Mockup top right corner of photo) -->
            <a href="{{ route('photos.show', $photo) }}" class="photo-zoom-btn" title="Perbesar" id="btn-zoom-{{ $photo->id }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                </svg>
            </a>

            <!-- Photo Image -->
            <div class="photo-img-wrapper">
                <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}" class="photo-img" loading="lazy">
            </div>

            <!-- Footer Actions -->
            <div class="photo-footer">
                <div class="photo-actions-left">
                    <!-- Edit Action (Pencil) -->
                    <a href="{{ route('photos.edit', $photo) }}" class="photo-action-btn edit-btn" title="Ubah Foto" id="btn-edit-{{ $photo->id }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>
                </div>
                <div class="photo-actions-right">
                    <!-- Delete Action (Trash) -->
                    <form action="{{ route('photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="delete-photo-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="photo-action-btn delete-btn" title="Hapus Foto" id="btn-delete-{{ $photo->id }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="empty-state">
        <svg class="empty-state-icon" viewBox="0 0 24 24">
            <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2zM8.5 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm1.5 4.5l2.5 3.01L16 13l4.5 6H3.5l5-6.5z"/>
        </svg>
        <h3>Belum ada foto</h3>
        <p>Silakan klik tombol + di kanan atas untuk menambahkan foto baru ke dalam album ini.</p>
    </div>
@endif
