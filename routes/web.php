<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\LocalOnly;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
