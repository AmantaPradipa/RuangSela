<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Chat dengan Admin/Terapis
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
                <p>Halo, ada yang bisa saya bantu?</p>
                <span class="timestamp">10:00 AM</span>
            </div>
            <div class="message sent">
                <p>Saya ingin bertanya tentang paket konsultasi.</p>
                <span class="timestamp">10:01 AM</span>
            </div>
        </div>
        <form class="chat-input-form">
            <input type="text" placeholder="Ketik pesan Anda..." class="chat-input">
            <button type="submit" class="send-button"><i class="ri-send-plane-fill"></i></button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>