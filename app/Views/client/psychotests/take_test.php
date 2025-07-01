<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
<?= esc($psychotest->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/test_process.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="test-container">
    <header class="test-header">
        <h1><?= esc($psychotest->title) ?></h1>
        <p><?= esc($psychotest->description) ?></p>
        <div class="progress-bar-container">
            <div id="main-progress-bar"></div>
        </div>
    </header>

    <form id="psychotest-form" action="<?= site_url('client/psikotes/submit') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="psychotest_id" value="<?= esc($psychotest->id) ?>">
        <section class="question-card">
            <p id="question-counter">Soal 1 dari <?= count($questions) ?></p>
            <h2 id="question-text"></h2>
            <div class="options-container" id="options"></div>
        </section>

        <div class="navigation-buttons">
            <button type="button" class="btn btn-secondary" id="prev-btn">
                <i class="ri-arrow-left-line"></i>
                Sebelumnya
            </button>
            <button type="button" class="btn btn-primary" id="next-btn">
                Selanjutnya
                <i class="ri-arrow-right-line"></i>
            </button>
        </div>

        <div class="pagination-grid" id="pagination-grid"></div>
        
        <p class="save-progress">Anda dapat menyimpan progress dan melanjutkan nanti. <a href="#">Simpan Progress</a></p>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
    const questionsData = <?= json_encode($questions) ?>;
</script>
<script src="<?= base_url('assets/js/pages/test_process.js') ?>"></script>
<?= $this->endSection() ?>
