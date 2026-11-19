<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    /**
     * Muestra el listado de categorías junto con el conteo de libros asociados.
     */
    public function index(): View
    {
        // Regla MVC: Consultas optimizadas con withCount para evitar consultas N+1 en la vista.
        $categorias = Categoria::withCount('libros')->orderBy('nombre', 'asc')->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create(): View
    {
        return view('categorias.create');
    }

    /**
     * Almacena una nueva categoría en la base de datos tras validar los datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $datosValidados = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:categorias,nombre'],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique' => 'Ya existe una categoría registrada con este nombre.',
            'nombre.max' => 'El nombre no puede exceder los 100 caracteres.',
        ]);

        Categoria::create($datosValidados);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Elimina una categoría si no tiene libros asociados (RF5).
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        // Regla MVC: La verificación de integridad la encapsula el modelo
        if ($categoria->tieneLibrosAsociados()) {
            return redirect()->route('categorias.index')->with(
                'error',
                "No se puede eliminar la categoría '{$categoria->nombre}' porque tiene libros asociados."
            );
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
