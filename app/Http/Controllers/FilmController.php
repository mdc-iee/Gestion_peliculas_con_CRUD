<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // con paginate(nº) devolverá el número de proyectos que escribamos dentro del paréntesis
        $films = Film::paginate(5);
        $fields = $films->first()->getFillable()??[];
        return view('films.lists', compact('films', 'fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        $values = $request->input();
        Film::create($values);
        return redirect()->route('films.index')->with('success', 'La película se ha creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $page = $request->input('page');
        $film->update($request->input());
        return redirect()->route('films.index')->with('success', 'La película se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();
        // Crea una variable de un solo uso
        return redirect()->route('films.index')->with('success', 'Película borrada.');
    }
}
