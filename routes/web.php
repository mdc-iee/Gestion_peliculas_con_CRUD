<?php
require __DIR__.'/auth.php';

use App\Http\Controllers\SetLanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name("main");
Route::view("estrenos", "estrenos")->name("estrenos");
Route::view("cartelera", "cartelera")->name("cartelera");
Route::view("about", "about")->name("about");

Route::fallback(function () {
    $ruta = request()->url();
    return "$ruta no existe";
});

Route::get('/dashboard', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta del cambio de idioma
Route::get("/lang/{lang}",SetLanguageController::class)->name('set_lang');;
