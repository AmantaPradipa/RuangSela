<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - RuangSela Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/global/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/variables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/app.css') ?>">
    
    <!-- Component CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/components/buttons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/cards.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/chat.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/forms.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/modals.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/sidebar.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/common.css') ?>">
    <?= $this->renderSection('pageStyles') ?>
</head>
<body>
    <div class="admin-layout">
        <?= $this->include('components/sidebars/admin_sidebar') ?>
        <div class="main-container">
            <?= $this->include('components/headers/admin_header') ?>
            <main class="content-wrapper">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
    <?= $this->renderSection('pageScripts') ?>
</body>
</html>
