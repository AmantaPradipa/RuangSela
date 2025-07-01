-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2025 pada 13.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruangsela`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `target_table` varchar(50) DEFAULT NULL,
  `target_id` int(11) UNSIGNED DEFAULT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `therapist_id` int(11) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `duration_minutes` int(11) NOT NULL DEFAULT 60,
  `status` enum('scheduled','completed','cancelled','no_show') NOT NULL DEFAULT 'scheduled',
  `meeting_link` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `title`, `content`, `excerpt`, `featured_image`, `is_published`, `created_at`, `updated_at`) VALUES
(8, 5, 'TESTING UPDATE 20', 'amfaiwfiawkamdkamwkdmakdmakawkwa', 'YAYAYAYYA', NULL, 1, '2025-06-30 15:33:48', '2025-06-30 15:34:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `audio_tones`
--

CREATE TABLE `audio_tones` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `frequency_hz` int(11) NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `audio_tones`
--

INSERT INTO `audio_tones` (`id`, `title`, `description`, `file_path`, `frequency_hz`, `is_public`, `created_at`) VALUES
(1, 'Nada 174 Hz', 'Nada ini dipercaya dapat mengurangi rasa sakit dan ketegangan.', 'assets/audio/pure_tones/174hz.mp3', 174, 1, '2025-06-30 00:55:14'),
(2, 'Nada 285 Hz', 'Nada ini dipercaya dapat membantu penyembuhan jaringan dan organ.', 'assets/audio/pure_tones/285hz.mp3', 285, 1, '2025-06-30 00:55:14'),
(3, 'Nada 417 Hz', 'Nada ini dipercaya dapat memfasilitasi perubahan dan membersihkan energi negatif.', 'assets/audio/pure_tones/417hz.mp3', 417, 1, '2025-06-30 00:55:14'),
(4, 'Nada 432 Hz', 'Nada ini dipercaya selaras dengan alam dan memiliki efek menenangkan.', 'assets/audio/pure_tones/432hz.mp3', 432, 1, '2025-06-30 00:55:14'),
(5, 'Nada 528 Hz', 'Nada ini dikenal sebagai frekuensi cinta dan dipercaya dapat memperbaiki DNA.', 'assets/audio/pure_tones/528hz.mp3', 528, 1, '2025-06-30 00:55:14'),
(6, 'Nada 639 Hz', 'Nada ini dipercaya dapat meningkatkan hubungan dan komunikasi.', 'assets/audio/pure_tones/639hz.mp3', 639, 1, '2025-06-30 00:55:14'),
(7, 'Nada 741 Hz', 'Nada ini dipercaya dapat membantu pembersihan dan ekspresi diri.', 'assets/audio/pure_tones/741hz.mp3', 741, 1, '2025-06-30 00:55:14'),
(8, 'Nada 852 Hz', 'Nada ini dipercaya dapat membangkitkan intuisi dan kesadaran spiritual.', 'assets/audio/pure_tones/852hz.mp3', 852, 1, '2025-06-30 00:55:14'),
(9, 'Nada 963 Hz', 'Nada ini dipercaya dapat menghubungkan dengan kesadaran universal.', 'assets/audio/pure_tones/963hz.mp3', 963, 1, '2025-06-30 00:55:14'),
(10, 'Nada 174 Hz', 'Nada ini dipercaya dapat mengurangi rasa sakit dan ketegangan.', 'assets/audio/pure_tones/174hz.mp3', 174, 1, '2025-06-30 11:57:25'),
(11, 'Nada 285 Hz', 'Nada ini dipercaya dapat membantu penyembuhan jaringan dan organ.', 'assets/audio/pure_tones/285hz.mp3', 285, 1, '2025-06-30 11:57:25'),
(12, 'Nada 417 Hz', 'Nada ini dipercaya dapat memfasilitasi perubahan dan membersihkan energi negatif.', 'assets/audio/pure_tones/417hz.mp3', 417, 1, '2025-06-30 11:57:25'),
(13, 'Nada 432 Hz', 'Nada ini dipercaya selaras dengan alam dan memiliki efek menenangkan.', 'assets/audio/pure_tones/432hz.mp3', 432, 1, '2025-06-30 11:57:25'),
(14, 'Nada 528 Hz', 'Nada ini dikenal sebagai frekuensi cinta dan dipercaya dapat memperbaiki DNA.', 'assets/audio/pure_tones/528hz.mp3', 528, 1, '2025-06-30 11:57:25'),
(15, 'Nada 639 Hz', 'Nada ini dipercaya dapat meningkatkan hubungan dan komunikasi.', 'assets/audio/pure_tones/639hz.mp3', 639, 1, '2025-06-30 11:57:25'),
(16, 'Nada 741 Hz', 'Nada ini dipercaya dapat membantu pembersihan dan ekspresi diri.', 'assets/audio/pure_tones/741hz.mp3', 741, 1, '2025-06-30 11:57:25'),
(17, 'Nada 852 Hz', 'Nada ini dipercaya dapat membangkitkan intuisi dan kesadaran spiritual.', 'assets/audio/pure_tones/852hz.mp3', 852, 1, '2025-06-30 11:57:25'),
(18, 'Nada 963 Hz', 'Nada ini dipercaya dapat menghubungkan dengan kesadaran universal.', 'assets/audio/pure_tones/963hz.mp3', 963, 1, '2025-06-30 11:57:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `appointment_id` int(11) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'general',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Apa itu RuangSela?', 'RuangSela adalah platform konsultasi kesehatan online yang menghubungkan Anda dengan dokter dan psikolog berpengalaman. Kami menyediakan layanan konsultasi kesehatan fisik dan mental yang dapat diakses kapan saja dan di mana saja melalui aplikasi mobile atau website.', 'Umum', 1, '2025-06-30 00:20:24', '2025-06-30 00:20:52'),
(2, 'Siapa saja yang bisa menggunakan layanan RuangSela?', 'Layanan kami dapat digunakan oleh siapa saja yang membutuhkan konsultasi kesehatan, baik untuk masalah fisik maupun mental, dari remaja hingga dewasa.', 'Umum', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:00'),
(3, 'Apakah RuangSela tersedia 24 jam?', 'Ya, Anda dapat mengakses platform dan menjadwalkan konsultasi kapan saja. Namun, ketersediaan setiap terapis atau dokter dapat bervariasi sesuai jadwal mereka.', 'Umum', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:04'),
(4, 'Bagaimana cara mengunduh aplikasi RuangSela?', 'Aplikasi kami tersedia di Google Play Store untuk pengguna Android dan di App Store untuk pengguna iOS. Cari \"RuangSela\" untuk mengunduh.', 'Umum', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:15'),
(5, 'Apakah RuangSela memiliki sertifikasi resmi?', 'Semua psikolog dan dokter yang terdaftar di platform kami memiliki lisensi resmi dan telah melewati proses verifikasi yang ketat.', 'Umum', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:21'),
(6, 'Apakah konsultasi di RuangSela bisa ditanggung asuransi?', 'Saat ini kami sedang bekerja sama dengan beberapa penyedia asuransi. Silakan periksa halaman Pembayaran atau hubungi layanan pelanggan kami untuk informasi lebih lanjut mengenai mitra asuransi kami.', 'Umum', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:25'),
(7, 'Bagaimana cara memulai sesi konsultasi?', 'Anda dapat memilih terapis atau dokter dari daftar, melihat jadwal yang tersedia, memilih waktu yang cocok, dan melakukan pembayaran untuk memesan sesi Anda.', 'Konsultasi', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:32'),
(8, 'Metode pembayaran apa saja yang diterima?', 'Kami menerima berbagai metode pembayaran, termasuk transfer bank, kartu kredit/debit, dan e-wallet populer seperti GoPay, OVO, dan Dana.', 'Pembayaran', 1, '2025-06-30 00:20:24', '2025-06-30 00:21:37'),
(9, 'Apakah saya bisa menggunakan RuangSela tanpa mendaftar?', 'Sebagian fitur publik seperti artikel, direktori terapis, dan audio terapi dapat diakses tanpa akun. Namun, untuk melakukan konsultasi atau psikotes, Anda perlu mendaftar sebagai klien atau terapis.', 'Umum', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(10, 'Apa itu audio therapy di RuangSela?', 'Audio therapy adalah fitur terapi suara yang memanfaatkan frekuensi tertentu (seperti 40Hz, 60Hz) untuk membantu relaksasi dan peningkatan fokus. Anda dapat mendengarkannya langsung melalui halaman Audio Therapy.', 'Umum', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(11, 'Apakah saya bisa menjadi terapis di RuangSela?', 'Ya, Anda bisa mendaftar sebagai terapis dengan melengkapi profil, mengunggah dokumen lisensi, dan menunggu proses verifikasi dari admin.', 'Konsultasi', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(12, 'Apa yang dimaksud dengan status verifikasi terapis?', 'Terapis yang baru mendaftar akan berstatus \"pending\" hingga dokumen lisensinya diverifikasi oleh admin. Setelah disetujui, statusnya akan berubah menjadi \"verified\" dan bisa mulai menerima klien.', 'Konsultasi', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(13, 'Bagaimana cara membeli paket konsultasi?', 'Anda dapat memilih paket yang tersedia, lalu mengunggah bukti pembayaran. Admin akan memverifikasi pembayaran Anda sebelum paket diaktifkan.', 'Pembayaran', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(14, 'Apakah saya bisa membatalkan paket yang sudah dibeli?', 'Paket yang sudah dibeli tidak dapat dibatalkan. Namun, jika terjadi kesalahan atau kendala, silakan hubungi tim support kami melalui fitur Tiket Bantuan.', 'Pembayaran', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(15, 'Bagaimana cara menjadwalkan sesi dengan terapis?', 'Setelah membeli paket, Anda dapat memilih terapis, melihat jadwal mereka, dan memesan waktu yang tersedia untuk sesi konsultasi.', 'Konsultasi', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(16, 'Apakah saya bisa melihat hasil psikotes saya?', 'Ya, setelah menyelesaikan tes psikologis, Anda dapat melihat skor, interpretasi hasil, dan riwayat tes pada dashboard Anda.', 'Konsultasi', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(17, 'Bagaimana saya tahu jika ada pesan baru dari terapis?', 'Sistem akan memberikan notifikasi real-time di dashboard Anda serta melalui email untuk pesan penting seperti pesan baru, reminder konsultasi, dan hasil psikotes.', 'Umum', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09'),
(18, 'Apakah informasi saya aman di RuangSela?', 'Kami menggunakan autentikasi berbasis peran, enkripsi password, dan logging aktivitas untuk menjaga keamanan dan privasi data Anda.', 'Umum', 1, '2025-06-30 00:23:09', '2025-06-30 00:23:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sessions_count` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `price`, `sessions_count`, `is_active`, `created_at`, `updated_at`, `features`) VALUES
(1, 'Paket Pengantar', '1 sesi online, akses artikel edukasi, komunitas, relaksasi, dan 1 psikotes', 199999.00, 1, 1, '2025-06-30 10:25:29', '2025-06-30 10:25:29', '[\"1 Sesi Konsultasi Online (60 Menit)\", \"Akses Penuh Artikel Edukasi\", \"Akses Penuh Diskusi Komunitas\", \"Akses Penuh Relaksasi Pure Tone\", \"Akses 1 Jenis Psikotes Pilihan\"]'),
(2, 'Paket Pendampingan', '2 sesi online, semua fitur dasar plus laporan singkat & prioritas chat', 499999.00, 2, 1, '2025-06-30 10:25:29', '2025-06-30 10:25:29', '[\"2 Sesi Konsultasi Online (masing-masing 60 Menit)\", \"Akses Penuh Artikel Edukasi\", \"Akses Penuh Diskusi Komunitas\", \"Akses Penuh Relaksasi Pure Tone\", \"Akses 2 Jenis Psikotes Pilihan\", \"Laporan Perkembangan Singkat\", \"Prioritas Respon Pop-up Chat Admin\"]'),
(3, 'Paket Transformasi', '4 sesi online, fitur premium dan review bulanan bersama psikolog', 849999.00, 4, 1, '2025-06-30 10:25:29', '2025-06-30 10:25:29', '[\"4 Sesi Konsultasi Online (masing-masing 60 Menit)\", \"Akses Penuh Artikel Edukasi Premium\", \"Akses Penuh Diskusi Komunitas Eksklusif\", \"Akses Penuh Relaksasi Pure Tone Frequency\", \"Akses Semua Jenis Psikotes\", \"Laporan Perkembangan Lengkap\", \"Sesi Review Bulanan dengan Psikolog\", \"Dukungan Penuh Pop-up Chat Admin 24/7\", \"Prioritas Akses ke Event Komunitas Eksklusif\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `platform_reviews`
--

CREATE TABLE `platform_reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `category` enum('general','ui_ux','bug_report','feature_request') NOT NULL DEFAULT 'general',
  `rating` tinyint(1) DEFAULT NULL,
  `comment` text NOT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `status` enum('new','acknowledged','in_progress','resolved') NOT NULL DEFAULT 'new',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `parent_comment_id` int(11) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress_notes`
--

CREATE TABLE `progress_notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `psychotests`
--

CREATE TABLE `psychotests` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `option_text` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `therapist_id` int(11) UNSIGNED NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `category` enum('bug','feedback','payment','other') NOT NULL DEFAULT 'other',
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_settings`
--

CREATE TABLE `system_settings` (
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_questions`
--

CREATE TABLE `test_questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `psychotest_id` int(11) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `question_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `psychotest_id` int(11) UNSIGNED NOT NULL,
  `total_score` int(11) NOT NULL,
  `result_summary` text DEFAULT NULL,
  `taken_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `therapists`
--

CREATE TABLE `therapists` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expertise` text DEFAULT NULL,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `education` text DEFAULT NULL,
  `license_number` varchar(100) DEFAULT NULL,
  `license_file` varchar(255) DEFAULT NULL,
  `verification_status` enum('unverified','pending','verified','rejected') NOT NULL DEFAULT 'unverified',
  `verification_notes` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `therapist_schedules`
--

CREATE TABLE `therapist_schedules` (
  `id` int(11) UNSIGNED NOT NULL,
  `therapist_id` int(11) UNSIGNED NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket_responses`
--

CREATE TABLE `ticket_responses` (
  `id` int(11) UNSIGNED NOT NULL,
  `ticket_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `sessions_used` int(11) NOT NULL DEFAULT 0,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `package_id`, `amount`, `status`, `payment_method`, `payment_proof`, `sessions_used`, `transaction_date`, `updated_at`) VALUES
(3, 9, 1, 199999.00, 'pending', 'GoPay', NULL, 0, '2025-06-30 07:30:05', '2025-06-30 07:30:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` enum('client','therapist','admin') DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'User account status',
  `profile_picture` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role`, `is_verified`, `is_active`, `profile_picture`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(5, 'arilgaming', 'arilgaming@gmail.com', '$2a$12$V2FYQjg8BlRWYAZ0C44ZVudSy0Vs8pvl8G5kt83TaEAgZLAqJcEEe', 'aril', NULL, 'therapist', 1, 1, NULL, NULL, NULL, '2025-06-30 01:11:34', '2025-06-30 11:20:24'),
(7, 'amanta', 'amanta0512@gmail.com', '$2a$12$0LHs53mycnxBRotvS4qPPuKdMkP6DftoZNQZ9KBM2ALM9EedFdmiG', 'Amanta', 'Pradipa', 'admin', 1, 1, NULL, NULL, NULL, '2025-06-30 09:22:38', '2025-06-30 09:22:53'),
(9, 'amantapradipa', 'tugusamanta10@gmail.com', '$2y$10$KAPlwsMsvx0PNgiVYMX0WubSAhJFKRWxFA1H0qWD1cBRZyTuM2R0S', 'amanta', NULL, 'client', 0, 1, NULL, NULL, NULL, '2025-06-30 03:48:28', '2025-06-30 03:48:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_action_type` (`action_type`),
  ADD KEY `idx_target_table` (`target_table`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_target_table_id` (`target_table`,`target_id`);

--
-- Indeks untuk tabel `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id_fk` (`client_id`),
  ADD KEY `therapist_id_fk` (`therapist_id`),
  ADD KEY `package_id_fk` (`package_id`);

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id_fk` (`author_id`);

--
-- Indeks untuk tabel `audio_tones`
--
ALTER TABLE `audio_tones`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id_fk` (`sender_id`),
  ADD KEY `receiver_id_fk` (`receiver_id`),
  ADD KEY `appointment_id_fk` (`appointment_id`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `platform_reviews`
--
ALTER TABLE `platform_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indeks untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id_fk` (`post_id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `parent_comment_id_fk` (`parent_comment_id`);

--
-- Indeks untuk tabel `progress_notes`
--
ALTER TABLE `progress_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id_fk` (`appointment_id`),
  ADD KEY `author_id_fk` (`author_id`);

--
-- Indeks untuk tabel `psychotests`
--
ALTER TABLE `psychotests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id_fk` (`question_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointment_id_unique` (`appointment_id`),
  ADD KEY `client_id_fk` (`client_id`),
  ADD KEY `therapist_id_fk` (`therapist_id`);

--
-- Indeks untuk tabel `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ticket_status` (`status`),
  ADD KEY `idx_ticket_priority` (`priority`),
  ADD KEY `idx_ticket_user_id` (`user_id`),
  ADD KEY `idx_ticket_category` (`category`);

--
-- Indeks untuk tabel `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`setting_key`);
ALTER TABLE `system_settings` ADD FULLTEXT KEY `idx_setting_value` (`setting_value`);

--
-- Indeks untuk tabel `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `psychotest_id_fk` (`psychotest_id`);

--
-- Indeks untuk tabel `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `psychotest_id_fk` (`psychotest_id`);

--
-- Indeks untuk tabel `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indeks untuk tabel `therapist_schedules`
--
ALTER TABLE `therapist_schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `therapist_day_unique` (`therapist_id`,`day_of_week`),
  ADD KEY `therapist_id_fk` (`therapist_id`);

--
-- Indeks untuk tabel `ticket_responses`
--
ALTER TABLE `ticket_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_response_ticket_id` (`ticket_id`),
  ADD KEY `idx_response_user_id` (`user_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `package_id_fk` (`package_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `audio_tones`
--
ALTER TABLE `audio_tones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `platform_reviews`
--
ALTER TABLE `platform_reviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `progress_notes`
--
ALTER TABLE `progress_notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `psychotests`
--
ALTER TABLE `psychotests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `therapists`
--
ALTER TABLE `therapists`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `therapist_schedules`
--
ALTER TABLE `therapist_schedules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ticket_responses`
--
ALTER TABLE `ticket_responses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `fk_activity_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_package_id_fk` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_therapist_id_fk` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_appointment_id_fk` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_messages_receiver_id_fk` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_messages_sender_id_fk` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `platform_reviews`
--
ALTER TABLE `platform_reviews`
  ADD CONSTRAINT `platform_reviews_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_parent_id_fk` FOREIGN KEY (`parent_comment_id`) REFERENCES `post_comments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `progress_notes`
--
ALTER TABLE `progress_notes`
  ADD CONSTRAINT `progress_notes_appointment_id_fk` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `progress_notes_author_id_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_question_id_fk` FOREIGN KEY (`question_id`) REFERENCES `test_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_appointment_id_fk` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_therapist_id_fk` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `fk_ticket_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_psychotest_id_fk` FOREIGN KEY (`psychotest_id`) REFERENCES `psychotests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_psychotest_id_fk` FOREIGN KEY (`psychotest_id`) REFERENCES `psychotests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_results_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `therapists`
--
ALTER TABLE `therapists`
  ADD CONSTRAINT `therapists_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `therapist_schedules`
--
ALTER TABLE `therapist_schedules`
  ADD CONSTRAINT `therapist_schedules_therapist_id_fk` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ticket_responses`
--
ALTER TABLE `ticket_responses`
  ADD CONSTRAINT `fk_response_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_response_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_package_id_fk` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
