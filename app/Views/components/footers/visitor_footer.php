<!-- CTA Section -->
<section class="cta-section">
    <h2>Siap Memulai Perjalanan Kesehatan Mental Anda?</h2>
    <p>Bergabunglah dengan ribuan orang lain yang telah menemukan dukungan melalui RuangSela. Daftar gratis atau jelajahi layanan kami sekarang.</p>
    <a href="<?= site_url('register') ?>" class="cta-button">Daftar Gratis Sekarang</a>
</section>

<!-- Footer Section -->
<footer class="site-footer">
    <div class="footer-container">
        <!-- Kolom 1: Tentang RuangSela -->
        <div class="footer-column">
            <h3>RuangSela</h3>
            <p>Platform kesehatan mental yang menyediakan akses mudah ke layanan konsultasi dan sumber daya untuk mendukung kesejahteraan mental Anda.</p>
        </div>
        
        <!-- Kolom 2: Tautan Cepat -->
        <div class="footer-column">
            <h3>Tautan Cepat</h3>
            <ul class="footer-links">
                <li><a href="<?= site_url('beranda') ?>">Beranda</a></li>
                <li><a href="<?= site_url('layanan') ?>">Layanan Kami</a></li>
                <li><a href="<?= site_url('konsultasi') ?>">Konsultasi</a></li>
                <li><a href="<?= site_url('artikel') ?>">Artikel</a></li>
                <li><a href="<?= site_url('psikotes') ?>">Tes Psikologi</a></li>
                <li><a href="<?= site_url('terapis') ?>">Daftar Terapis</a></li>
                <li><a href="<?= site_url('faq') ?>">FAQ</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Hubungi Kami -->
        <div class="footer-column">
            <h3>Hubungi Kami</h3>
            <ul class="contact-info">
                <li>
                    <i class="ri-mail-line"></i>
                    <span>ruangsela@gmail.com</span>
                </li>
                <li>
                    <i class="ri-phone-line"></i>
                    <span>+62 857 9249 5816</span>
                </li>
                <li>
                    <i class="ri-map-pin-line"></i>
                    <span>Jl. Majapahit No.62, Gomong, Kec. Selaparang, Kota Mataram, NTB 83115</span>
                </li>
            </ul>
        </div>

        <!-- Kolom 4: Ikuti Kami -->
        <div class="footer-column">
            <h3>Ikuti Kami</h3>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="ri-facebook-box-fill"></i></a>
                <a href="#" aria-label="Twitter"><i class="ri-twitter-x-fill"></i></a>
                <a href="#" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="ri-linkedin-box-fill"></i></a>
            </div>
        </div>
    </div>

    <hr class="footer-divider">

    <div class="footer-copyright">
        <!-- Menggunakan date('Y') untuk tahun yang dinamis -->
        <p>&copy; <?= date('Y') ?> RuangSela. Semua Hak Cipta Dilindungi.</p>
    </div>
</footer>
