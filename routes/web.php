<?php

use App\Http\Controllers\Admin\AdminCatalogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Customer-Facing Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/calculator', [HomeController::class, 'calculator'])->name('calculator');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/inquire', [HomeController::class, 'submitInquiry'])->name('inquire.submit');

/*
|--------------------------------------------------------------------------
| Dashboard & Profile Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Management Panel (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Inquiries CRM
    Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('admin.inquiries.index');
    Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('admin.inquiries.show');
    Route::put('/inquiries/{inquiry}', [AdminInquiryController::class, 'update'])->name('admin.inquiries.update');
    Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('admin.inquiries.destroy');

    // Projects Portfolio Management
    Route::resource('projects', AdminProjectController::class, ['as' => 'admin']);

    // Design Catalog Management
    Route::resource('catalog', AdminCatalogController::class, ['as' => 'admin']);

    // Testimonials Management
    Route::resource('testimonials', AdminTestimonialController::class, ['as' => 'admin'])->except(['create', 'show', 'edit']);

    // Workshop Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
});

require __DIR__.'/auth.php';
