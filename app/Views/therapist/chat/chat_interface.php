<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Chat dengan Klien/Admin
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/components/chat.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="chat-container">
    <header class="chat-header">
        <h1>Chat</h1>
    </header>

    <div class="chat-window">
        <div class="chat-messages">
            <!-- Contoh pesan -->
            <div class="message received">
                <p>Selamat pagi, Dokter. Saya ingin menjadwalkan sesi.</p>
                <span class="timestamp">09:30 AM</span>
            </div>
            <div class="message sent">
                <p>Tentu, silakan pilih jadwal yang tersedia.</p>
                <span class="timestamp">09:31 AM</span>
            </div>
        </div>
        <form class="chat-input-form">
            <input type="text" placeholder="Ketik pesan Anda..." class="chat-input">
            <button type="submit" class="send-button"><i class="ri-send-plane-fill"></i></button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>