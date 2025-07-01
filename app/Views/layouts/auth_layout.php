<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'RuangSela') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/variables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/forms.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/buttons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/cards.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/auth.css') ?>">
</head>
<body>
    <div class="auth-container">
        <div class="left-pane">
            <div class="left-pane-content">
                <div class="auth-logo">
                    <img src="<?= base_url('assets/images/logos/logo-white.png') ?>" alt="Logo RuangSela">
                    <h1>RuangSela</h1>
                </div>
                <h2>Temukan Ketenangan dan Dukungan Profesional di Sini.</h2>
                <p>Bergabunglah dengan komunitas kami untuk memulai perjalanan Anda menuju kesehatan mental yang lebih baik.</p>
            </div>
        </div>
        <div class="right-pane-wrapper">
            <a href="<?= site_url('beranda') ?>" class="auth-back-button"><i class="ri-arrow-left-line"></i> Kembali ke Beranda</a>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</body>
</html>