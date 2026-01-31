<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLanguageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $lang)
    {
        // Establecemos la variable de sesión
        session()->put('lang', $lang);
        app()->setLocale($lang);
        // Devuelveme a la última página en la que estaba aunque no es necesario ya que laravel lo hace de por si
        return redirect()->back();
    }
}
