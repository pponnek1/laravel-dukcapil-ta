<footer id="footer" class="footer dark-background">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Disdukcapil Klaten</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Pemuda No.294, Dusun 1, Tegalyoso</p>
                        <p>Kec. Klaten Selatan, Kabupaten Klaten, Jawa Tengah 57424, Indonesia</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>+62 272 321048</span></p>
                        <p><strong>Email:</strong> <span>disdukcapil@klaten.go.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <!-- Jika ada akun resmi, isi link-nya -->
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Tautan Penting</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}/#about">Tentang Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('daftar-antrian.index') }}">Layanan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        @foreach ($antrianList as $antrian)
                            <li><i class="bi bi-chevron-right"></i> <a href="#">{{ $antrian->nama_layanan }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Berlangganan Informasi</h4>
                    <p>Masukkan email Anda untuk mendapatkan update layanan dan pengumuman terbaru dari Disdukcapil Klaten.</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
                        <div class="newsletter-form">
                            <input type="email" name="email" placeholder="Email Anda">
                            <input type="submit" value="Subscribe">
                        </div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Permintaan berlangganan Anda telah dikirim. Terima kasih!</div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container text-center">
            <p>© Copyright <strong class="px-1 sitename">Disdukcapil Klaten</strong>. All Rights Reserved</p>
            <div class="credits">
                Dinas Kependudukan dan Pencatatan Sipil Kabupaten Klaten
            </div>
        </div>
    </div>

</footer>
