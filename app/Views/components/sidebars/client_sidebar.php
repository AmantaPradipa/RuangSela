<aside class="client-sidebar">
    <div class="sidebar-header">
        <a href="<?= site_url('client/dashboard') ?>" class="sidebar-logo">
            <img src="<?= base_url('assets/images/logos/logo-green.png') ?>" alt="Logo RuangSela">
            <span>RuangSela</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <p class="menu-header">Menu</p>
        <ul>
            <li><a href="<?= site_url('client/dashboard') ?>" class="nav-link <?= (uri_string() == 'client/dashboard') ? 'active' : '' ?>"><i class="ri-dashboard-line"></i> <span>Dashboard</span></a></li>
            <li><a href="<?= site_url('client/konsultasi') ?>" class="nav-link <?= (strpos(uri_string(), 'client/konsultasi') !== false) ? 'active' : '' ?>"><i class="ri-calendar-2-line"></i> <span>Konsultasi</span></a></li>
            <li><a href="<?= site_url('client/psikotes') ?>" class="nav-link <?= (strpos(uri_string(), 'client/psikotes') !== false) ? 'active' : '' ?>"><i class="ri-file-text-line"></i> <span>Psikotes</span></a></li>
            <li><a href="<?= site_url('client/audio-frequency') ?>" class="nav-link <?= (strpos(uri_string(), 'client/audio-frequency') !== false) ? 'active' : '' ?>"><i class="ri-radio-2-line"></i> <span>Frekuensi</span></a></li>
            <li><a href="<?= site_url('client/artikel') ?>" class="nav-link <?= (strpos(uri_string(), 'client/artikel') !== false) ? 'active' : '' ?>"><i class="ri-newspaper-line"></i> <span>Artikel</span></a></li>
            <li><a href="<?= site_url('client/komunitas') ?>" class="nav-link <?= (strpos(uri_string(), 'client/komunitas') !== false) ? 'active' : '' ?>"><i class="ri-group-line"></i> <span>Komunitas</span></a></li>
            <li><a href="<?= site_url('client/paket') ?>" class="nav-link <?= (strpos(uri_string(), 'client/paket') !== false) ? 'active' : '' ?>"><i class="ri-inbox-unarchive-line"></i> <span>Paket</span></a></li>
        </ul>
        <p class="menu-header">Akun</p>
        <ul>
            <li><a href="<?= site_url('client/profil') ?>" class="nav-link <?= (strpos(uri_string(), 'client/profil') !== false) ? 'active' : '' ?>"><i class="ri-user-line"></i> <span>Profil</span></a></li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <div class="user-profile">
            <img src="<?= asset_url(session()->get('profile_picture'), 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar">
            <div class="user-info">
                <p class="name"><?= esc(session()->get('first_name')) ?></p>
                <p class="role">Klien</p>
            </div>
            <a href="<?= site_url('logout') ?>" class="logout-icon" title="Keluar"><i class="ri-logout-box-r-line"></i></a>
        </div>
    </div>
</aside>
