@extends('layouts.app')

@section('title', 'Photo Album Studio - Modern Full-Stack Laravel App')

@section('content')
<div class="lp-wrapper">
    <!-- NAVIGATION BAR -->
    <nav class="lp-nav">
        <div class="lp-nav-container">
            <a href="{{ route('home') }}" class="lp-logo">
                <div class="lp-logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/>
                    </svg>
                </div>
                <span>PhotoAlbum</span>
            </a>

            <ul class="lp-nav-links">
                <li><a href="#fitur" class="lp-nav-link">Fitur Utama</a></li>
                <li><a href="#techstack" class="lp-nav-link">Tech Stack</a></li>
                <li><a href="#developer" class="lp-nav-link">Pengembang</a></li>
            </ul>

            <div class="lp-nav-actions">
                <a href="{{ route('login') }}" class="btn btn-dark" id="nav-btn-login">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary" id="nav-btn-register">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="lp-hero">
        <div class="lp-hero-content">
            <div class="lp-hero-badge">
                <span class="lp-hero-badge-pulse"></span>
                Portofolio Full-Stack Laravel
            </div>
            
            <h1 class="lp-hero-title">
                Simpan & Kelola Koleksi Foto <span>Secara Elegan</span>
            </h1>
            
            <p class="lp-hero-desc">
                Aplikasi manajemen album foto privat berbasis <strong>Laravel 13 & PHP 8.5</strong>. Dirancang dengan keamanan tinggi, antarmuka glassmorphism yang modern, dan responsif di seluruh perangkat.
            </p>

            <div class="lp-hero-cta">
                <a href="{{ route('login') }}" class="lp-btn-primary" id="hero-btn-demo">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    Coba Live Demo
                </a>
                <a href="{{ route('register') }}" class="lp-btn-outline" id="hero-btn-register">
                    Buat Akun Baru
                </a>
            </div>

            <div class="lp-hero-stats">
                <div class="lp-stat-item">
                    <h4>100%</h4>
                    <p>Privat & Aman</p>
                </div>
                <div class="lp-stat-item">
                    <h4>Laravel 13</h4>
                    <p>Framework Core</p>
                </div>
                <div class="lp-stat-item">
                    <h4>Vite 8</h4>
                    <p>Asset Bundler</p>
                </div>
            </div>
        </div>

        <!-- APP PREVIEW MOCKUP -->
        <div class="lp-mockup-wrapper">
            <div class="lp-mockup-glow"></div>
            <div class="lp-mockup-card">
                <div class="lp-mockup-header">
                    <div class="lp-mockup-dots">
                        <div class="lp-mockup-dot dot-red"></div>
                        <div class="lp-mockup-dot dot-yellow"></div>
                        <div class="lp-mockup-dot dot-green"></div>
                    </div>
                    <div class="lp-mockup-title">app.photoalbum.test / dashboard</div>
                </div>

                <div class="lp-mockup-body">
                    <div class="lp-mockup-topbar">
                        <span style="font-weight: 700; font-size: 0.9rem;">Album Foto Saya</span>
                        <input type="text" class="lp-mockup-search" value="Cari album..." readonly>
                    </div>

                    <div class="lp-mockup-grid">
                        <div class="lp-mockup-album">
                            <div class="lp-mockup-album-thumb">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                            </div>
                            <h5>Liburan 2026</h5>
                            <p>12 Foto • Dibuat Baru</p>
                        </div>

                        <div class="lp-mockup-album">
                            <div class="lp-mockup-album-thumb" style="background: linear-gradient(135deg, #78350f, #451a03);">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l0.9 2.6H15.6l-2.2 1.6 0.8 2.6-2.2-1.6-2.2 1.6 0.8-2.6-2.2-1.6h2.7z"/>
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                            </div>
                            <h5>Portofolio Project</h5>
                            <p>8 Foto • Privat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- TECH STACK SECTION -->
    <section class="lp-section" id="techstack">
        <div class="lp-section-header">
            <span class="lp-section-tag">Arsitektur Modern</span>
            <h2 class="lp-section-title">Ditenagai Teknologi Terkini</h2>
            <p class="lp-section-desc">
                Dibangun dari nol menggunakan prinsip clean code, struktur MVC Laravel, dan sistem styling performa tinggi.
            </p>
        </div>

        <div class="lp-tech-grid">
            <div class="lp-tech-card">
                <h4 class="lp-tech-name">PHP 8.5</h4>
                <p class="lp-tech-role">Backend Engine</p>
            </div>
            <div class="lp-tech-card">
                <h4 class="lp-tech-name">Laravel 13</h4>
                <p class="lp-tech-role">Full-Stack Framework</p>
            </div>
            <div class="lp-tech-card">
                <h4 class="lp-tech-name">Vite 8</h4>
                <p class="lp-tech-role">Asset Bundling & HMR</p>
            </div>
            <div class="lp-tech-card">
                <h4 class="lp-tech-name">SQLite DB</h4>
                <p class="lp-tech-role">Database Management</p>
            </div>
            <div class="lp-tech-card">
                <h4 class="lp-tech-name">Custom CSS</h4>
                <p class="lp-tech-role">Glassmorphism Design</p>
            </div>
        </div>
    </section>

    <!-- FEATURES GRID -->
    <section class="lp-section" id="fitur">
        <div class="lp-section-header">
            <span class="lp-section-tag">Fitur Utama</span>
            <h2 class="lp-section-title">Solusi Penyimpanan Memori Privat</h2>
            <p class="lp-section-desc">
                Semua fitur dirancang untuk kemudahan manajemen foto dan perlindungan data pengguna.
            </p>
        </div>

        <div class="lp-features-grid">
            <div class="lp-feature-card">
                <div class="lp-feature-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                </div>
                <h4>Otentikasi & Keamanan</h4>
                <p>Sistem registrasi & login terenkripsi Bcrypt dengan proteksi middleware session dan CSRF protection.</p>
            </div>

            <div class="lp-feature-card">
                <div class="lp-feature-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
                    </svg>
                </div>
                <h4>Manajemen Album CRUD</h4>
                <p>Buat, perbarui, dan kelompokkan foto ke dalam album spesifik dengan kontrol penuh atas data Anda.</p>
            </div>

            <div class="lp-feature-card">
                <div class="lp-feature-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                </div>
                <h4>Galeri & Upload Foto</h4>
                <p>Upload gambar dengan kompresi yang cepat, penyortiran otomatis, dan preview modal interaktif.</p>
            </div>

            <div class="lp-feature-card">
                <div class="lp-feature-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 6h16v10H4zM20 18H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h16c1.1 0 2-.9 2-2v10c0 1.1-.9 2-2 2zm-8 2h4v2h-4z"/>
                    </svg>
                </div>
                <h4>Antarmuka Responsive</h4>
                <p>Tampilan fleksibel berbasis glassmorphism dan tema warna hangat yang nyaman di perangkat mobile maupun desktop.</p>
            </div>
        </div>
    </section>

    <!-- DEVELOPER SPOTLIGHT -->
    <section class="lp-section" id="developer">
        <div class="lp-dev-card">
            <div class="lp-dev-info">
                <div class="lp-dev-avatar">BA</div>
                <div class="lp-dev-text">
                    <h3>Ben Abednego</h3>
                    <p>Full-Stack Developer</p>
                    <span>Dibuat sebagai proyek portofolio aplikasi web berbasis Laravel & Web Engineering.</span>
                </div>
            </div>

            <div class="lp-dev-links">
                <a href="{{ route('login') }}" class="btn btn-primary">Uji Coba Aplikasi</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="lp-footer">
        <p>&copy; {{ date('Y') }} Photo Album Studio. Built with ❤️ by <strong>Ben Abednego</strong> using Laravel & Vite.</p>
    </footer>
</div>
@endsection

