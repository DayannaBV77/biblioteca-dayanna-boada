<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibroController extends Controller
{
    /**
     * Muestra el listado de libros con paginación, filtros opcionales y categorías para el select (RF1, RF6, RF7).
     */
    public function index(Request $request): View
    {
        $categoriaId = $request->filled('categoria_id') ? (int) $request->query('categoria_id') : null;
        $terminoBusqueda = $request->query('buscar');

        // Regla MVC: Controlador delgado usando el modelo con eager loading 'with' (evita problema N+1)
        // y delegando la lógica de filtrado a los scopes del modelo.
        $libros = Libro::with('categoria')
            ->filtrar([
                'buscar' => $terminoBusqueda,
                'categoria_id' => $categoriaId,
            ])
            ->latest('id')
            ->paginate(6)
            ->withQueryString(); // Preserva los filtros en la paginación

        $categorias = Categoria::orderBy('nombre', 'asc')->get();

        return view('libros.index', compact('libros', 'categorias', 'categoriaId', 'terminoBusqueda'));
    }

    /**
     * Muestra el formulario para registrar un nuevo libro (RF2).
     */
    public function create(): View
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();

        return view('libros.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo libro validando estrictamente las reglas de negocio (RF2).
     */
    public function store(Request $request): RedirectResponse
    {
        $anioActual = (int) date('Y');

        $datosValidados = $request->validate([
            'titulo' => ['required', 'string', 'min:3', 'max:255'],
            'autor' => ['required', 'string', 'min:2', 'max:255'],
            'anio' => ['required', 'integer', 'between:1500,' . $anioActual],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'disponible' => ['nullable', 'boolean'],
        ], [
            'titulo.required' => 'El título del libro es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'autor.required' => 'El autor del libro es obligatorio.',
            'anio.required' => 'El año de publicación es obligatorio.',
            'anio.between' => "El año de publicación debe estar comprendido entre 1500 y {$anioActual}.",
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        // Aseguramos el valor booleano para 'disponible' (si el checkbox no se marca, se establece false)
        $datosValidados['disponible'] = $request->boolean('disponible');

        Libro::create($datosValidados);

        return redirect()->route('libros.index')->with('success', 'Libro registrado exitosamente en la biblioteca.');
    }

    /**
     * Muestra el formulario de edición de un libro existente (RF3).
     */
    public function edit(Libro $libro): View
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();

        return view('libros.edit', compact('libro', 'categorias'));
    }

    /**
     * Actualiza la información del libro en la base de datos (RF3).
     */
    public function update(Request $request, Libro $libro): RedirectResponse
    {
        $anioActual = (int) date('Y');

        $datosValidados = $request->validate([
            'titulo' => ['required', 'string', 'min:3', 'max:255'],
            'autor' => ['required', 'string', 'min:2', 'max:255'],
            'anio' => ['required', 'integer', 'between:1500,' . $anioActual],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'disponible' => ['nullable', 'boolean'],
        ], [
            'titulo.required' => 'El título del libro es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'autor.required' => 'El autor del libro es obligatorio.',
            'anio.required' => 'El año de publicación es obligatorio.',
            'anio.between' => "El año de publicación debe estar comprendido entre 1500 y {$anioActual}.",
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        $datosValidados['disponible'] = $request->boolean('disponible');

        $libro->update($datosValidados);

        return redirect()->route('libros.index')->with('success', 'Información del libro actualizada exitosamente.');
    }

    /**
     * Elimina el libro de la base de datos (RF4).
     */
    public function destroy(Libro $libro): RedirectResponse
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado de la biblioteca.');
    }
}
