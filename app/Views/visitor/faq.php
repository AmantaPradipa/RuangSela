<?= $this->extend('layouts/visitor_layout') ?>

<?= $this->section('title') ?>
Pertanyaan Umum (FAQ) - RuangSela
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/faq.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('components/headers/visitor_header', ['header_class' => 'header-static']) ?>

<main>
    <!-- BAGIAN 1: HEADER FAQ -->
    <section class="faq-header-section">
        <div class="faq-header-container">
            <h2>
                Pertanyaan Umum <span class="highlight-text">(FAQ)</span>
            </h2>
            <p class="subtitle">
                Temukan jawaban atas pertanyaan yang sering diajukan mengenai layanan RuangSela.
            </p>
            <form class="faq-search-form" action="#" method="get">
                <div class="search-container">
                    <i class="ri-search-line search-icon"></i>
                    <input type="search" name="q" placeholder="Ketik pertanyaan Anda...">
                    <button type="submit">Cari</button>
                </div>
            </form>
        </div>
    </section>

    <!-- BAGIAN 2: KONTEN UTAMA FAQ -->
    <section class="faq-content-section">
        <div class="faq-content-container">
            <!-- Navigasi Tab -->
            <nav class="faq-tabs">
                <?php $firstTab = true; ?>
                <?php foreach ($faqs as $category => $faqList) : ?>
                    <a class="tab-link <?= $firstTab ? 'active' : '' ?>" data-tab="<?= esc(strtolower(str_replace(' ', '-', $category))) ?>"><?= esc($category) ?></a>
                    <?php $firstTab = false; ?>
                <?php endforeach; ?>
            </nav>

            <!-- Konten Tab -->
            <?php $firstTabContent = true; ?>
            <?php foreach ($faqs as $category => $faqList) : ?>
                <div id="<?= esc(strtolower(str_replace(' ', '-', $category))) ?>" class="tab-content <?= $firstTabContent ? 'active' : '' ?>">
                    <?php foreach ($faqList as $faq) : ?>
                        <div class="faq-item">
                            <button class="faq-question">
                                <span><?= esc($faq['question']) ?></span>
                                <i class="ri-arrow-down-s-line faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p><?= esc($faq['answer']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php $firstTabContent = false; ?>
            <?php endforeach; ?>

        </div>
    </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/faq.js') ?>"></script>
<?= $this->endSection() ?>
