@extends('auth::layouts.app')

@section('title', 'Welcome - Valorent')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Text -->
            <div class="col-md-6 hero-text">
                <h1 class="display-4 fw-bold">Sewa Akun Valorant dengan Mudah</h1>
                <p class="lead text-muted">
                    Temukan akun Valorant terbaik untuk kebutuhan Anda. Mulai dari akun Sultan dengan skin premium hingga akun Low Rank untuk latihan.
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary btn-lg">
                    Browse Catalog
                </a>
            </div>

            <!-- Right Column: Image -->
            <div class="col-md-6 hero-image text-center">
                <img src="https://i0.wp.com/www.gimbot.com/wp-content/uploads/2022/11/VALORANT-Featured.jpg?fit=1200%2C675&ssl=1" alt="Valorant Hero Image">
            </div>
        </div>
    </div>
</section>

<!-- About / Informasi Website -->
<section class="info text-center">
    <div class="container">
        <h2 class="mb-4">Tentang Valorent</h2>
        <p class="lead mx-auto" style="max-width: 700px;">
            Valorent adalah platform terpercaya untuk sewa akun Valorant dengan berbagai kategori dan harga yang kompetitif. Kami berkomitmen memberikan pengalaman sewa yang aman, mudah, dan cepat bagi para gamer di seluruh Indonesia.
        </p>
    </div>
</section>

<!-- Security & Privacy Section -->
<section class="security text-center">
    <div class="container">
        <h2 class="mb-5">Jaminan Keamanan & Privasi</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h5>Keamanan Akun Terjamin</h5>
                <p>Kami menggunakan protokol keamanan terbaru untuk melindungi akun dan data pribadi Anda dari akses tidak sah.</p>
            </div>
            <div class="col-md-4 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-file-lock2-fill"></i>
                </div>
                <h5>Privasi Data Pengguna</h5>
                <p>Data Anda disimpan dengan aman dan tidak akan dibagikan ke pihak ketiga tanpa izin Anda.</p>
            </div>
            <div class="col-md-4 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h5>Transaksi Aman & Terpercaya</h5>
                <p>Proses pembayaran kami dilengkapi dengan enkripsi dan metode pembayaran yang terpercaya.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features / Keunggulan Layanan -->
<section class="features text-center">
    <div class="container">
        <h2 class="mb-5">Kenapa Memilih Valorent?</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <h5>Proses Cepat</h5>
                <p>Sewa akun dengan proses cepat dan mudah tanpa ribet.</p>
            </div>
            <div class="col-md-3 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h5>Support 24/7</h5>
                <p>Tim support kami siap membantu Anda kapan saja.</p>
            </div>
            <div class="col-md-3 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-award-fill"></i>
                </div>
                <h5>Akun Berkualitas</h5>
                <p>Akun dengan rank dan skin premium yang selalu diperbarui.</p>
            </div>
            <div class="col-md-3 mb-4 feature-card">
                <div class="feature-icon">
                    <i class="bi bi-wallet2"></i>
                </div>
                <h5>Harga Kompetitif</h5>
                <p>Harga sewa yang bersaing dan transparan tanpa biaya tersembunyi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Optional: Testimonial Section -->
<section class="testimonials text-center">
    <div class="container">
        <h2 class="mb-5">Apa Kata Mereka?</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p>"Valorent memudahkan saya mendapatkan akun Valorant dengan skin keren tanpa harus beli mahal!"</p>
                    <h6 class="mt-3">- Andi, Gamer</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p>"Proses sewa cepat dan supportnya ramah. Saya sangat puas menggunakan Valorent."</p>
                    <h6 class="mt-3">- Sari, Streamer</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p>"Akun yang disewakan selalu update dan aman. Recommended banget buat yang mau coba rank tinggi."</p>
                    <h6 class="mt-3">- Budi, Pro Player</h6>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection