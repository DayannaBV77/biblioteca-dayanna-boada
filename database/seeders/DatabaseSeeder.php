<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with elegant library collection.
     */
    public function run(): void
    {
        // 5 Categorías temáticas de alta literatura y pensamiento
        $filosofia = Categoria::create([
            'nombre' => 'Filosofía Clásica y Existencial',
            'descripcion' => 'Tratados, diálogos y reflexiones fundamentales sobre la existencia, ética y conocimiento.',
        ]);

        $altaLiteratura = Categoria::create([
            'nombre' => 'Alta Literatura Universal',
            'descripcion' => 'Obras cumbre de la narrativa mundial reconocidas por su profundidad estética y humana.',
        ]);

        $ensayo = Categoria::create([
            'nombre' => 'Ensayo Literario y Crítica',
            'descripcion' => 'Prosa reflexiva sobre el lenguaje, la estética, la sociedad y el arte de la lectura.',
        ]);

        $arte = Categoria::create([
            'nombre' => 'Arte, Estética y Arquitectura',
            'descripcion' => 'Estudios sobre diseño espacial, corrientes visuales e historia del canon artístico.',
        ]);

        $poesia = Categoria::create([
            'nombre' => 'Poesía y Lírica Mayor',
            'descripcion' => 'Antologías y poemarios esenciales de la tradición lírica occidental y universal.',
        ]);

        // Mínimo 10 libros originales y variados con títulos, autores, años y disponibilidad
        $libros = [
            [
                'titulo' => 'Meditaciones',
                'autor' => 'Marco Aurelio',
                'anio' => 170, // ajustado dentro del rango válido de la biblioteca (>= 1500 en reglas RF2 o ediciones canónicas) -> usaremos año de edición canónica impresa
            ],
        ];

        // Lista de 12 libros con años entre 1500 y 2026 (cumpliendo con la validación RF2)
        Libro::create([
            'titulo' => 'Ensayos (Edición Canónica)',
            'autor' => 'Michel de Montaigne',
            'anio' => 1580,
            'categoria_id' => $ensayo->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'Don Quijote de la Mancha',
            'autor' => 'Miguel de Cervantes Saavedra',
            'anio' => 1605,
            'categoria_id' => $altaLiteratura->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'Discurso del Método',
            'autor' => 'René Descartes',
            'anio' => 1637,
            'categoria_id' => $filosofia->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'Crítica de la Razón Pura',
            'autor' => 'Immanuel Kant',
            'anio' => 1781,
            'categoria_id' => $filosofia->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'Las Flores del Mal (Les Fleurs du mal)',
            'autor' => 'Charles Baudelaire',
            'anio' => 1857,
            'categoria_id' => $poesia->id,
            'disponible' => false,
        ]);

        Libro::create([
            'titulo' => 'Crimen y Castigo',
            'autor' => 'Fiódor Dostoyevski',
            'anio' => 1866,
            'categoria_id' => $altaLiteratura->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'Así Habló Zaratustra',
            'autor' => 'Friedrich Nietzsche',
            'anio' => 1883,
            'categoria_id' => $filosofia->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'En Busca del Tiempo Perdido: Por el camino de Swann',
            'autor' => 'Marcel Proust',
            'anio' => 1913,
            'categoria_id' => $altaLiteratura->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'El Elogio de la Sombra',
            'autor' => 'Jun\'ichirō Tanizaki',
            'anio' => 1933,
            'categoria_id' => $arte->id,
            'disponible' => false,
        ]);

        Libro::create([
            'titulo' => 'Ficciones',
            'autor' => 'Jorge Luis Borges',
            'anio' => 1944,
            'categoria_id' => $altaLiteratura->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'La Poética del Espacio',
            'autor' => 'Gaston Bachelard',
            'anio' => 1957,
            'categoria_id' => $arte->id,
            'disponible' => true,
        ]);

        Libro::create([
            'titulo' => 'Canto Cósmico',
            'autor' => 'Ernesto Cardenal',
            'anio' => 1989,
            'categoria_id' => $poesia->id,
            'disponible' => true,
        ]);
    }
}
