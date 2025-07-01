<aside class="admin-sidebar">
    <div class="sidebar-header">
        <a href="<?= site_url('admin/dashboard') ?>" class="sidebar-logo">
            <img src="<?= base_url('assets/images/logos/logo-green.png') ?>" alt="Logo RuangSela">
            <span>RuangSela</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <p class="menu-header">Menu</p>
        <ul>
            <li><a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>"><i class="ri-dashboard-line"></i> <span>Dashboard</span></a></li>
            <li><a href="<?= site_url('admin/users') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/users') !== false) ? 'active' : '' ?>"><i class="ri-group-line"></i> <span>Pengguna</span></a></li>
            <li><a href="<?= site_url('admin/therapists/verification') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/therapists') !== false) ? 'active' : '' ?>"><i class="ri-user-star-line"></i> <span>Terapis</span></a></li>
            <li><a href="#" class="nav-link"><i class="ri-calendar-event-line"></i> <span>Janji Temu</span></a></li>
            <li><a href="<?= site_url('admin/transactions') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/transactions') !== false) ? 'active' : '' ?>"><i class="ri-wallet-3-line"></i> <span>Transaksi</span></a></li>
        </ul>
        <p class="menu-header">Konten</p>
        <ul>
            <li><a href="<?= site_url('admin/articles') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/articles') !== false) ? 'active' : '' ?>"><i class="ri-newspaper-line"></i> <span>Artikel</span></a></li>
            <li><a href="<?= site_url('admin/packages') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/packages') !== false) ? 'active' : '' ?>"><i class="ri-box-3-line"></i> <span>Paket</span></a></li>
            <li><a href="<?= site_url('admin/psychotests') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/psychotests') !== false) ? 'active' : '' ?>"><i class="ri-file-text-line"></i> <span>Psikotes</span></a></li>
            <li><a href="<?= site_url('admin/audio-tones') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/audio-tones') !== false) ? 'active' : '' ?>"><i class="ri-volume-up-line"></i> <span>Audio Tones</span></a></li>
            <li><a href="<?= site_url('admin/faqs') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/faqs') !== false) ? 'active' : '' ?>"><i class="ri-question-answer-line"></i> <span>FAQ</span></a></li>
        </ul>
        <p class="menu-header">Sistem</p>
        <ul>
            <li><a href="<?= site_url('admin/tickets') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/tickets') !== false) ? 'active' : '' ?>"><i class="ri-customer-service-2-line"></i> <span>Tiket Dukungan</span></a></li>
            <li><a href="<?= site_url('admin/settings') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/settings') !== false) ? 'active' : '' ?>"><i class="ri-settings-3-line"></i> <span>Pengaturan</span></a></li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <div class="user-profile">
            <img src="<?= asset_url(session()->get('profile_picture'), 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar">
            <div class="user-info">
                <p class="name"><?= esc(session()->get('first_name')) ?></p>
                <p class="role">Admin</p>
            </div>
            <a href="<?= site_url('logout') ?>" class="logout-icon" title="Keluar"><i class="ri-logout-box-r-line"></i></a>
        </div>
    </div>
</aside>
