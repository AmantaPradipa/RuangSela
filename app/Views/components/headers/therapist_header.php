<header class="therapist-header">
    <div class="header-left">
        <div class="search-bar">
            <i class="ri-search-line"></i>
            <input type="text" placeholder="Cari sesuatu...">
        </div>
    </div>
    <div class="header-right">
        <div class="notification-icon">
            <i class="ri-message-2-line"></i>
            <div class="badge">0</div>
        </div>
        <div class="notification-icon">
            <i class="ri-notification-3-line"></i>
            <div class="badge">0</div>
        </div>
        <div class="profile-dropdown">
            <img src="<?= asset_url(session()->get('profile_picture'), 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar">
        </div>
    </div>
</header>