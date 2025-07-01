<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title', 'RuangSela - Dukungan Kesehatan Mental Anda') ?></title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- RemixIcon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/global/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/variables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global/app.css') ?>">
    
    <!-- Component CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/components/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/buttons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/cards.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/forms.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/modals.css') ?>">

    <!-- Page Specific CSS -->
    <?= $this->renderSection('pageStyles') ?>

</head>
<body>

    <!-- Header Section -->
    <?= $this->include('components/headers/visitor_header') ?>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer Section -->
    <?= $this->include('components/footers/visitor_footer') ?>

    <!-- Global JS -->
    <script src="<?= base_url('assets/js/global/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/global/header.js') ?>"></script>
    
    <!-- Page Specific JS -->
    <?= $this->renderSection('pageScripts') ?>

</body>
</html>
