<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Beli Paket Konsultasi
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/payment.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <!-- Header & Stepper -->
    <h1 class="main-title">Detail Pembayaran</h1>
    <div class="stepper d-flex align-items-center">
        <div class="step done">1</div><div class="step-line done"></div>
        <div class="step active">2</div><div class="step-line"></div>
        <div class="step todo">3</div>
    </div>

    <!-- Payment Summary Section -->
    <section class="payment-section card">
        <div class="card-header">
            <h2>Ringkasan Pembayaran</h2>
        </div>
        <div class="summary-row"><span>Paket Konsultasi</span><span><?= esc($package['name']) ?></span></div>
        <div class="summary-row"><span>Durasi Paket</span><span><?= esc($package['description']) ?></span></div>
        <div class="summary-row"><span>Harga Paket</span><span>Rp <?= number_format($package['price'], 0, ',', '.') ?></span></div>
        <div class="summary-row summary-total"><span>Total Pembayaran</span><span>Rp <?= number_format($package['price'], 0, ',', '.') ?></span></div>
    </section>

    <!-- Payment Method Selection -->
    <section class="payment-section card">
        <div class="card-header">
            <h2><i class="ri-bank-line"></i> Pilih Metode Pembayaran</h2>
        </div>
        <div class="payment-options-list">
            <label for="bca" class="payment-option">
                <img src="<?= base_url('assets/images/banks/bca-logo.png') ?>" alt="BCA Bank">
                <span class="rekening">No. Rekening: 1234567890</span>
                <input type="radio" name="payment_method" id="bca" value="BCA">
                <i class="ri-check-line check-icon"></i>
            </label>
            <label for="mandiri" class="payment-option">
                <img src="<?= base_url('assets/images/banks/mandiri-logo.png') ?>" alt="Mandiri">
                <span class="rekening">No. Rekening: 0987654321</span>
                <input type="radio" name="payment_method" id="mandiri" value="Mandiri">
                <i class="ri-check-line check-icon"></i>
            </label>
            <label for="bni" class="payment-option">
                <img src="<?= base_url('assets/images/banks/bni-logo.png') ?>" alt="BNI">
                <span class="rekening">No. Rekening: 1122334455</span>
                <input type="radio" name="payment_method" id="bni" value="BNI">
                <i class="ri-check-line check-icon"></i>
            </label>
            <label for="bri" class="payment-option">
                <img src="<?= base_url('assets/images/banks/bri-logo.png') ?>" alt="BRI">
                <span class="rekening">No. Rekening: 5544332211</span>
                <input type="radio" name="payment_method" id="bri" value="BRI">
                <i class="ri-check-line check-icon"></i>
            </label>
        </div>

        <h2 class="section-title mt-4"><i class="ri-wallet-line"></i> E-Wallet</h2>
        <div class="ewallet-grid">
            <label for="gopay" class="ewallet-option">
                <img src="<?= base_url('assets/images/ewallets/gopay-logo.png') ?>" alt="GoPay">
                <input type="radio" name="payment_method" id="gopay" value="GoPay">
                <i class="ri-check-line check-icon"></i>
            </label>
            <label for="ovo" class="ewallet-option">
                <img src="<?= base_url('assets/images/ewallets/ovo-logo.png') ?>" alt="OVO">
                <input type="radio" name="payment_method" id="ovo" value="OVO">
                <i class="ri-check-line check-icon"></i>
            </label>
            <label for="dana" class="ewallet-option">
                <img src="<?= base_url('assets/images/ewallets/dana-logo.png') ?>" alt="Dana">
                <input type="radio" name="payment_method" id="dana" value="Dana">
                <i class="ri-check-line check-icon"></i>
            </label>
            <label for="linkaja" class="ewallet-option">
                <img src="<?= base_url('assets/images/ewallets/linkaja-logo.png') ?>" alt="LinkAja">
                <input type="radio" name="payment_method" id="linkaja" value="LinkAja">
                <i class="ri-check-line check-icon"></i>
            </label>
        </div>
    </section>

    <!-- Payment Proof Upload -->
    <section class="payment-section card">
        <div class="card-header">
            <h2><i class="ri-upload-cloud-line"></i> Unggah Bukti Pembayaran</h2>
        </div>
        <form action="<?= site_url('client/paket/processPurchase') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="package_id" value="<?= esc($package['id']) ?>">
            <input type="hidden" name="amount" value="<?= esc($package['price']) ?>">
            <input type="hidden" name="payment_method" id="selected_payment_method">

            <div class="form-group file-upload-group">
                <label for="payment_proof" class="file-upload-label">
                    <i class="ri-image-add-line"></i> Pilih File Bukti Pembayaran
                </label>
                <input type="file" name="payment_proof" id="payment_proof" accept="image/*,application/pdf" required>
                <span class="file-name" id="file-name">Belum ada file yang dipilih</span>
            </div>

            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="action-buttons">
                <a href="<?= site_url('client/paket') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
            </div>
        </form>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentOptions = document.querySelectorAll('input[name="payment_method"]');
        const selectedPaymentMethodInput = document.getElementById('selected_payment_method');
        const paymentProofInput = document.getElementById('payment_proof');
        const fileNameSpan = document.getElementById('file-name');

        paymentOptions.forEach(radio => {
            radio.addEventListener('change', () => {
                document.querySelectorAll('.payment-option, .ewallet-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                if (radio.checked) {
                    radio.closest('.payment-option, .ewallet-option').classList.add('selected');
                    selectedPaymentMethodInput.value = radio.value;
                }
            });
        });

        paymentProofInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameSpan.textContent = this.files[0].name;
            } else {
                fileNameSpan.textContent = 'Belum ada file yang dipilih';
            }
        });
    });
</script>
<?= $this->endSection() ?>
