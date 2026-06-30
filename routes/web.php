<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HighlightController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\ContentJurusanController;
use App\Http\Controllers\Admin\PageSectionController;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', function () { return view('tentangkami'); })->name('tentangkami');
Route::get('/visi-misi', function () { return view('visi-misi'); })->name('visi-misi');
Route::get('/profile', function () { return view('profile'); })->name('profile');
Route::get('/fasilitas', function () { return view('fasilitas'); })->name('fasilitas');
Route::get('/ppdb', function () { return view('ppdb'); })->name('ppdb');
Route::get('/skill-passport', function () { return view('skill-passport'); })->name('skill-passport');
Route::get('/podcast', function () { return view('podcast'); })->name('podcast');
Route::get('/lab', function () { return view('lab'); })->name('lab');
Route::get('/safety-riding', function () { return view('safety-riding'); })->name('safety-riding');

// Public News
Route::get('/news', [PublicNewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [PublicNewsController::class, 'show'])->name('news.show');

// Public Contact Form
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/kontak', function () { return view('kontak'); })->name('contact');

// Jurusan Pages
Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/akuntansi', function () { return view('jurusan.akuntansi'); })->name('akuntansi');
    Route::get('/perhotelan', function () { return view('jurusan.perhotelan'); })->name('perhotelan');
    Route::get('/tei', function () { return view('jurusan.tei'); })->name('tei');
    Route::get('/titl', function () { return view('jurusan.titl'); })->name('titl');
    Route::get('/tm', function () { return view('jurusan.tm'); })->name('tm');
    Route::get('/tkro', function () { return view('jurusan.tkro'); })->name('tkro');
    Route::get('/tsm', function () { return view('jurusan.tsm'); })->name('tsm');
    Route::get('/tki', function () { return view('jurusan.tki'); })->name('tki');
});

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (Protected)
Route::middleware(['admin.auth','no.cache'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes for highlight, news, popup
    Route::resource('highlight', HighlightController::class);
    Route::resource('news', NewsController::class);
    Route::resource('popup', PopupController::class);
    Route::resource('alumni', AlumniController::class);
    Route::resource('content-jurusan', ContentJurusanController::class);
    
    // Messages management
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{id}', [PesanController::class, 'show'])->name('pesan.show');
    Route::post('/pesan/{id}/reply-email', [PesanController::class, 'replyEmail'])->name('pesan.replyEmail');
    Route::post('/pesan/{id}/mark-read', [PesanController::class, 'markRead'])->name('pesan.markRead');
    Route::delete('/pesan/{id}', [PesanController::class, 'destroy'])->name('pesan.destroy');

    // ── Podcast ────────────────────────────────────────────────────────────────
    // ── Podcast ────────────────────────────────────────────────────────────────
    Route::get('/podcast', [PageSectionController::class, 'indexPodcast'])->name('podcast.index');
    Route::get('/podcast/create', [PageSectionController::class, 'createPodcast'])->name('podcast.create');
    Route::post('/podcast', [PageSectionController::class, 'storePodcast'])->name('podcast.store');
    Route::get('/podcast/edit', [PageSectionController::class, 'editPodcast'])->name('podcast.edit');
    Route::put('/podcast', [PageSectionController::class, 'updatePodcast'])->name('podcast.update');

    // ── Lab Komputer ───────────────────────────────────────────────────────────
    Route::get('/lab', [PageSectionController::class, 'indexLab'])->name('lab.index');
    Route::get('/lab/create', [PageSectionController::class, 'createLab'])->name('lab.create');
    Route::post('/lab', [PageSectionController::class, 'storeLab'])->name('lab.store');
    Route::get('/lab/edit', [PageSectionController::class, 'editLab'])->name('lab.edit');
    Route::put('/lab', [PageSectionController::class, 'updateLab'])->name('lab.update');

    // ── Safety Riding ──────────────────────────────────────────────────────────
    Route::get('/safety-riding', [PageSectionController::class, 'indexSafetyRiding'])->name('safety-riding.index');
    Route::get('/safety-riding/create', [PageSectionController::class, 'createSafetyRiding'])->name('safety-riding.create');
    Route::post('/safety-riding', [PageSectionController::class, 'storeSafetyRiding'])->name('safety-riding.store');
    Route::get('/safety-riding/edit', [PageSectionController::class, 'editSafetyRiding'])->name('safety-riding.edit');
    Route::put('/safety-riding', [PageSectionController::class, 'updateSafetyRiding'])->name('safety-riding.update');

    // ── Shared: Delete element & delete section (semua page_key) ──────────────
    Route::delete('/page-section/{key}/section/{sIdx}/element/{eIdx}', [PageSectionController::class, 'deleteElement'])->name('pagesection.deleteElement');
    Route::delete('/page-section/{key}/section/{sIdx}', [PageSectionController::class, 'deleteSection'])->name('pagesection.deleteSection');
});
