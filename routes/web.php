<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\LocalOnly;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/sl/{slug}', [ShortLinkController::class, 'redirect'])->name('short-link.redirect');
Route::get('/not-found', [ShortLinkController::class, 'notFound'])->name('short-link.not-found');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/create-link', [DashboardController::class, 'createLink'])->name('dashboard.create-link');
    Route::post('/update-link/{id}', [DashboardController::class, 'updateLink'])->name('dashboard.update-link');
    Route::delete('/delete-link/{id}', [DashboardController::class, 'deleteLink'])->name('dashboard.delete-link');
});

Route::middleware(['auth'])->prefix('short-link')->group(function () {
    Route::post('/copy-increment/{id}', [ShortLinkController::class, 'copyIncrement'])->name('short-link.copy-increment');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(LocalOnly::class)->prefix('dev')->group(function () {
    Route::get('/back', [TestController::class, 'test']);

    Route::get('/page', function () {
        return view('pages.test');
    });

    Route::post('/ajax', function (Request $request) {
        $text = $request->input('text');

        if (strlen($text) < 3) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: Le texte doit contenir au moins 3 caractères.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Bonjour $text",
            'data' => $text
        ]);
    })->name('test.ajax');
});

require __DIR__.'/auth.php';
