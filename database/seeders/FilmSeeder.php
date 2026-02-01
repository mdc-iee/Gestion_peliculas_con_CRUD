<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Esta función llama 5 veces a la fábrica y crea los proyectos en la tabla de la base de datos (si hay 50, solo creará 5)
        Film::factory()->count(20)->create();
    }
}
