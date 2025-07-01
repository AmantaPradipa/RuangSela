<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('uploads/(:any)', 'FileController::show/$1');

// ===================================================================
// RUTE PUBLIK (Dapat diakses tanpa login)
// ===================================================================
$routes->get('beranda', 'HomeController::index');
$routes->addRedirect('/', 'beranda'); 

// Halaman statis
$routes->get('layanan', 'PageController::layanan');
$routes->get('packages', 'PageController::konsultasi');
$routes->get('konsultasi', 'PageController::konsultasi');
$routes->get('artikel', 'PageController::artikel');
$routes->get('artikel/detail/(:num)', 'PageController::artikelDetail/$1');
$routes->get('psychotest', 'PageController::psikotes');
$routes->get('psikotes', 'PageController::psikotes');
$routes->get('terapis', 'PageController::terapis');
$routes->get('terapis/detail/(:num)', 'PageController::terapisDetail/$1');
$routes->get('faq', 'PageController::faq');
$routes->get('audio-frequency', 'PageController::audioFrequency');

// ===================================================================
// RUTE AUTENTIKASI
// ===================================================================
$routes->get('login', 'AuthController::login', ['filter' => 'guest']);
$routes->post('login', 'AuthController::attemptLogin', ['filter' => 'guest']);
$routes->get('register', 'AuthController::register', ['filter' => 'guest']);
$routes->post('register', 'AuthController::attemptRegister', ['filter' => 'guest']);
$routes->get('select-role', 'AuthController::selectRole'); 
$routes->post('select-role', 'AuthController::attemptRoleSelection');
$routes->get('logout', 'AuthController::logout');
$routes->get('forgot-password', 'AuthController::forgotPassword');
$routes->post('forgot-password', 'AuthController::attemptForgotPassword');

// ===================================================================
// RUTE DASBOR UTAMA (Pengalihan berdasarkan peran)
// ===================================================================
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// ===================================================================
// RUTE UNTUK KLIEN (CLIENT)
// ===================================================================
$routes->group('client', ['namespace' => 'App\Controllers\Client', 'filter' => 'client'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Konsultasi & Janji Temu
    $routes->get('konsultasi', 'AppointmentController::index');
    $routes->get('konsultasi/book', 'AppointmentController::book');
    $routes->get('konsultasi/book/(:num)', 'AppointmentController::book/$1');
    $routes->post('konsultasi/save', 'AppointmentController::saveAppointment');
    $routes->get('konsultasi/prepare/(:num)', 'AppointmentController::prepareSession/$1');
    $routes->get('konsultasi/audio-prepare/(:num)', 'AppointmentController::audioPrepare/$1');
    $routes->get('konsultasi/join/(:num)', 'AppointmentController::joinSession/$1');

    // Psikotes
    $routes->get('psikotes', 'PsychotestController::index');
    $routes->get('psikotes/take/(:num)', 'PsychotestController::take/$1');
    $routes->post('psikotes/submit', 'PsychotestController::submitTest');
    $routes->get('psikotes/result/(:num)', 'PsychotestController::result/$1');

    // Fitur Lainnya
    $routes->get('audio-frequency', 'AudioFrequencyController::index');
    $routes->get('artikel', 'ArticleController::clientArticleIndex');
    $routes->get('komunitas', 'PostController::index');
    $routes->get('paket', 'PackageController::index');
    $routes->get('paket/purchase/(:num)', 'PackageController::purchase/$1');
    $routes->post('paket/processPurchase', 'PackageController::processPurchase');
    $routes->get('paket/purchase-success', 'PackageController::purchaseSuccess');
    
    // Profil & Aktivitas
    $routes->get('profil', 'ProfileController::index');
    $routes->post('profil/update', 'ProfileController::update');
    $routes->get('aktivitas', 'ActivityLogController::index');

    // Transaksi
    $routes->get('transactions', 'TransactionController::index');
    $routes->get('transactions/view/(:num)', 'TransactionController::view/$1');
});

// ===================================================================
// RUTE UNTUK TERAPIS (THERAPIST)
// ===================================================================
$routes->group('therapist', ['namespace' => 'App\Controllers\Therapist', 'filter' => 'therapist'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Manajemen Jadwal & Klien
    $routes->get('jadwal', 'ScheduleController::index');
    $routes->post('jadwal/save', 'ScheduleController::saveSchedule');
    $routes->get('jadwal/delete/(:num)', 'ScheduleController::deleteSchedule/$1');
    $routes->get('klien', 'ClientManagementController::index');
    $routes->get('klien/view/(:num)', 'ClientManagementController::viewClient/$1');
    $routes->get('klien/create', 'ClientManagementController::create');
    $routes->post('klien/save', 'ClientManagementController::save');
    $routes->post('klien/save-note', 'ClientManagementController::saveProgressNote');
    $routes->get('klien/edit-note/(:num)', 'ClientManagementController::editProgressNote/$1');
    $routes->post('klien/update-note/(:num)', 'ClientManagementController::updateProgressNote/$1');
    $routes->delete('klien/delete-note/(:num)', 'ClientManagementController::deleteProgressNote/$1');

    // Manajemen Konten
    $routes->get('artikel', 'ArticleController::therapistArticlesIndex');
    $routes->get('artikel/create', 'ArticleController::create');
    $routes->post('artikel/save', 'ArticleController::save');
    $routes->get('artikel/edit/(:num)', 'ArticleController::edit/$1');
    $routes->post('artikel/update/(:num)', 'ArticleController::update/$1');
    $routes->get('artikel/delete/(:num)', 'ArticleController::delete/$1');

    // Komunitas & Ulasan
    $routes->get('komunitas', 'PostController::index');
    $routes->get('ulasan', 'ReviewController::index');

    // Profil
    $routes->get('profil', 'ProfileController::index');
    $routes->post('profil/update', 'ProfileController::update');

    // Janji Temu Terapis
    $routes->get('appointments', 'AppointmentController::index');
    $routes->get('appointments/join/(:num)', 'AppointmentController::joinSession/$1');
});

// ===================================================================
// RUTE UNTUK ADMIN
// ===================================================================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Manajemen Pengguna & Terapis
    $routes->get('users/create', 'UserManagementController::create');
    $routes->resource('users', ['controller' => 'UserManagementController', 'except' => 'show']);
    $routes->get('therapists/verification', 'TherapistVerificationController::index');
    $routes->get('therapists/verify/(:num)', 'TherapistVerificationController::view/$1');
    $routes->post('therapists/verify/(:num)', 'TherapistVerificationController::verify/$1');
    $routes->post('therapists/reject/(:num)', 'TherapistVerificationController::reject/$1');

    // Manajemen Konten & Fitur
    // Manajemen Konten & Fitur (Articles)
    $routes->get('articles', 'ArticleManagementController::adminArticleIndex');
    $routes->get('articles/create', 'ArticleManagementController::adminArticleCreate');
    $routes->post('articles/save', 'ArticleManagementController::adminArticleSave');
    $routes->get('articles/edit/(:num)', 'ArticleManagementController::adminArticleEdit/$1');
    $routes->post('articles/update/(:num)', 'ArticleManagementController::adminArticleUpdate/$1');
    $routes->get('articles/delete/(:num)', 'ArticleManagementController::adminArticleDelete/$1');
    $routes->resource('packages', ['controller' => 'PackageManagementController', 'except' => 'show']);
    $routes->resource('faqs', ['controller' => 'FAQManagementController', 'except' => 'show']);
    $routes->resource('audio-tones', ['controller' => 'AudioToneManagementController', 'except' => 'show']);
    
    // Manajemen Psikotes
    $routes->resource('psychotests', ['controller' => 'PsychotestManagementController', 'except' => 'show']);
    $routes->get('psychotests/manage-questions/(:num)', 'PsychotestManagementController::manageQuestions/$1');
    $routes->post('psychotests/questions/save', 'PsychotestManagementController::saveQuestion');
    $routes->get('psychotests/questions/delete/(:num)', 'PsychotestManagementController::deleteQuestion/$1');

    // Dukungan & Laporan
    $routes->get('tickets', 'SupportTicketController::index');
    $routes->get('tickets/view/(:num)', 'SupportTicketController::view/$1');
    $routes->post('tickets/update-status/(:num)', 'SupportTicketController::updateStatus/$1');
    $routes->get('tickets/delete/(:num)', 'SupportTicketController::delete/$1');
    
    // Manajemen Transaksi
    $routes->get('transactions', 'TransactionManagementController::index');
    $routes->get('transactions/(:any)', 'TransactionManagementController::index/$1');
    $routes->get('transactions/view/(:num)', 'TransactionManagementController::view/$1');
    $routes->post('transactions/update-status/(:num)', 'TransactionManagementController::updateStatus/$1');
    $routes->get('transactions/delete/(:num)', 'TransactionManagementController::delete/$1');

        // Pengaturan Sistem
    $routes->get('settings', 'SystemSettingController::index');
    $routes->post('settings/save', 'SystemSettingController::save');
    $routes->post('settings/update/(:any)', 'SystemSettingController::update/$1');
    $routes->get('settings/delete/(:any)', 'SystemSettingController::delete/$1');
});