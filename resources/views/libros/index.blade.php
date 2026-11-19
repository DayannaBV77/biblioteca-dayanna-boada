@extends('layouts.app')

@section('title', 'Libros · Biblioteca de Dayanna')

@section('content')
<div class="space-y-6">

    <!-- Cabecera de la sección -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2">
                <span class="text-blue-500">📖</span> Catálogo de Obras
            </h2>
            <p class="text-sm text-slate-400 mt-0.5">Explora las ediciones de literatura selecta, filosofía y arte.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('libros.create') }}" 
               class="inline-flex items-center px-4 py-2.5 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-500/25 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Libro
            </a>
        </div>
    </div>

    <!-- Barra de búsqueda y filtros combinados (RF6 y RF7) -->
    <div class="glass-panel p-4 rounded-2xl">
        <form method="GET" action="{{ route('libros.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
            <!-- Búsqueda por título o autor -->
            <div class="md:col-span-6">
                <label for="buscar" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                    Buscar por título o autor
                </label>
                <div class="relative">
                    <input type="text" 
                           name="buscar" 
                           id="buscar" 
                           value="{{ request('buscar') }}" 
                           placeholder="Ej. Dostoyevski, Ficciones, Descartes..." 
                           class="w-full bg-slate-900/80 border border-slate-700/80 rounded-xl px-4 py-2.5 pl-10 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Filtro por categoría -->
            <div class="md:col-span-4">
                <label for="categoria_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                    Filtrar por categoría
                </label>
                <select name="categoria_id" 
                        id="categoria_id" 
                        class="w-full bg-slate-900/80 border border-slate-700/80 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ (string) request('categoria_id') === (string) $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones de acción del filtro -->
            <div class="md:col-span-2 flex items-center gap-2">
                <button type="submit" 
                        class="w-full py-2.5 px-4 rounded-xl font-medium text-sm text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 transition">
                    Filtrar
                </button>
                @if (request()->hasAny(['buscar', 'categoria_id']) && (request('buscar') || request('categoria_id')))
                    <a href="{{ route('libros.index') }}" 
                       class="py-2.5 px-3 rounded-xl text-sm text-slate-400 hover:text-white bg-slate-900 border border-slate-800 hover:border-slate-700 transition" 
                       title="Limpiar filtros">
                        ✕
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Lista de Libros (RF1) -->
    @if ($libros->isEmpty())
        <div class="glass-panel p-12 text-center rounded-2xl">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-white">No se encontraron libros</h3>
            <p class="text-sm text-slate-400 mt-1 max-w-md mx-auto">
                No hay obras registradas que coincidan con los criterios de búsqueda seleccionados.
            </p>
            @if (request()->hasAny(['buscar', 'categoria_id']))
                <a href="{{ route('libros.index') }}" class="inline-block mt-4 text-sm text-blue-400 hover:underline">
                    Restablecer filtros de búsqueda
                </a>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($libros as $libro)
                <div class="glass-card rounded-2xl p-5 flex flex-col justify-between hover:border-slate-700/80 transition duration-300">
                    <div>
                        <!-- Categoría y Estado de Disponibilidad -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-purple-950/40 text-purple-300 border border-purple-800/40">
                                {{ $libro->categoria->nombre }}
                            </span>
                            
                            @if ($libro->disponible)
                                <span class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-950/40 text-emerald-400 border border-emerald-800/40">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1.5"></span>
                                    Disponible
                                </span>
                            @else
                                <span class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full bg-rose-950/40 text-rose-400 border border-rose-800/40">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-400 mr-1.5"></span>
                                    En préstamo
                                </span>
                            @endif
                        </div>

                        <!-- Título y Autor -->
                        <h3 class="text-lg font-bold text-white leading-snug line-clamp-2">
                            {{ $libro->titulo }}
                        </h3>
                        <p class="text-sm text-slate-300 mt-1">
                            <span class="text-slate-500">Autor:</span> {{ $libro->autor }}
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            <span class="text-slate-500">Año de edición/publicación:</span> {{ $libro->anio }}
                        </p>
                    </div>

                    <!-- Acciones del Libro (RF3 y RF4) -->
                    <div class="mt-5 pt-4 border-t border-slate-800/80 flex items-center justify-end gap-2">
                        <a href="{{ route('libros.edit', $libro) }}" 
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-300 bg-blue-950/40 hover:bg-blue-900/50 border border-blue-800/50 transition">
                            Editar
                        </a>

                        <!-- Eliminación con modal/confirmación y verbo DELETE (RF4) -->
                        <form method="POST" action="{{ route('libros.destroy', $libro) }}" onsubmit="return confirm('¿Confirmas que deseas eliminar «{{ addslashes($libro->titulo) }}» de la biblioteca?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-300 bg-rose-950/40 hover:bg-rose-900/50 border border-rose-800/50 transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación preservando filtros (RF6 y RF7) -->
        <div class="pt-4">
            {{ $libros->links() }}
        </div>
    @endif

</div>
@endsection
