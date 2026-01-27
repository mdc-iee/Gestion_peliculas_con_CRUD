<?php
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::fallback(function () {
    $ruta = request()->url();
    return "$ruta no existe";
});

Route::get('/dashboard', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta del cambio de idioma
Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['es', 'en', 'fr', 'ru'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');
