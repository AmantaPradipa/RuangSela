<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Tambah Pertanyaan Psikotes
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/psychotest_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Tambah Pertanyaan untuk Psikotes: <?= esc($psychotest->title) ?></h1>
    </header>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <section class="card">
        <form action="<?= site_url('admin/psychotests/questions/save/' . $psychotest->id) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="question_text">Teks Pertanyaan</label>
                    <textarea id="question_text" name="question_text" class="form-control" rows="3" required><?= old('question_text') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="question_type">Tipe Pertanyaan</label>
                    <select id="question_type" name="question_type" class="form-control" required>
                        <option value="multiple_choice" <?= old('question_type') == 'multiple_choice' ? 'selected' : '' ?>>Pilihan Ganda</option>
                        <option value="text" <?= old('question_type') == 'text' ? 'selected' : '' ?>>Teks Bebas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="question_order">Urutan</label>
                    <input type="number" id="question_order" name="question_order" class="form-control" value="<?= old('question_order') ?>" required>
                </div>
                <div class="form-group full-width">
                    <label for="options">Pilihan Jawaban (untuk Pilihan Ganda, pisahkan dengan koma)</label>
                    <textarea id="options" name="options" class="form-control" rows="3" placeholder="Contoh: Sangat Setuju, Setuju, Tidak Setuju"><?= old('options') ?></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="correct_answer">Jawaban Benar (opsional, untuk penilaian otomatis)</label>
                    <input type="text" id="correct_answer" name="correct_answer" class="form-control" value="<?= old('correct_answer') ?>">
                </div>
                <div class="form-group">
                    <label for="score">Skor</label>
                    <input type="number" id="score" name="score" class="form-control" value="<?= old('score') ?>" required>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/psychotests/manage-questions/' . $psychotest->id) ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Pertanyaan</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>