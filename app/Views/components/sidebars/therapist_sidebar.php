<aside class="therapist-sidebar">
    <div class="sidebar-header">
        <a href="<?= site_url('therapist/dashboard') ?>" class="sidebar-logo">
            <img src="<?= base_url('assets/images/logos/logo-green.png') ?>" alt="Logo RuangSela">
            <span>RuangSela</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <p class="menu-header">Menu</p>
        <ul>
            <li><a href="<?= site_url('therapist/dashboard') ?>" class="nav-link <?= (uri_string() == 'therapist/dashboard') ? 'active' : '' ?>"><i class="ri-dashboard-line"></i> <span>Dashboard</span></a></li>
            <li><a href="<?= site_url('therapist/jadwal') ?>" class="nav-link <?= (strpos(uri_string(), 'therapist/jadwal') !== false) ? 'active' : '' ?>"><i class="ri-calendar-2-line"></i> <span>Jadwal</span></a></li>
            <li><a href="<?= site_url('therapist/klien') ?>" class="nav-link <?= (strpos(uri_string(), 'therapist/klien') !== false) ? 'active' : '' ?>"><i class="ri-group-line"></i> <span>Klien</span></a></li>
            <li><a href="<?= site_url('therapist/artikel') ?>" class="nav-link <?= (strpos(uri_string(), 'therapist/artikel') !== false) ? 'active' : '' ?>"><i class="ri-newspaper-line"></i> <span>Artikel</span></a></li>
            <li><a href="<?= site_url('therapist/komunitas') ?>" class="nav-link <?= (strpos(uri_string(), 'therapist/komunitas') !== false) ? 'active' : '' ?>"><i class="ri-message-3-line"></i> <span>Komunitas</span></a></li>
        </ul>
        <p class="menu-header">Akun</p>
        <ul>
            <li><a href="<?= site_url('therapist/profil') ?>" class="nav-link <?= (strpos(uri_string(), 'therapist/profil') !== false) ? 'active' : '' ?>"><i class="ri-user-line"></i> <span>Profil</span></a></li>
            <li><a href="<?= site_url('therapist/ulasan') ?>" class="nav-link <?= (strpos(uri_string(), 'therapist/ulasan') !== false) ? 'active' : '' ?>"><i class="ri-star-line"></i> <span>Ulasan</span></a></li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <div class="user-profile">
            <img src="<?= asset_url(session()->get('profile_picture'), 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar">
            <div class="user-info">
                <p class="name"><?= esc(session()->get('first_name')) ?></p>
                <p class="role">Terapis</p>
            </div>
            <a href="<?= site_url('logout') ?>" class="logout-icon" title="Keluar"><i class="ri-logout-box-r-line"></i></a>
        </div>
    </div>
</aside>
