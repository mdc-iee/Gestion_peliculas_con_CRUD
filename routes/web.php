<?php
require __DIR__.'/auth.php';

use App\Http\Controllers\MainController;
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

