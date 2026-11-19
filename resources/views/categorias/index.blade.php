@extends('layouts.app')

@section('title', 'Categorías · Biblioteca de Dayanna')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2">
                <span class="text-purple-400">🏷️</span> Categorías Temáticas
            </h2>
            <p class="text-sm text-slate-400 mt-0.5">Clasificación canónica de alta literatura, filosofía, ensayo y arte.</p>
        </div>
        <a href="{{ route('categorias.create') }}" 
           class="inline-flex items-center px-4 py-2.5 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 shadow-lg shadow-purple-500/25 transition duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Categoría
        </a>
    </div>

    <!-- Lista de Categorías (RF5) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($categorias as $categoria)
            <div class="glass-card rounded-2xl p-5 flex flex-col justify-between hover:border-slate-700/80 transition duration-300">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700">
                            {{ $categoria->libros_count }} {{ Str::plural('obra', $categoria->libros_count) }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-white">
                        {{ $categoria->nombre }}
                    </h3>

                    @if ($categoria->descripcion)
                        <p class="text-xs text-slate-400 mt-2 line-clamp-3 leading-relaxed">
                            {{ $categoria->descripcion }}
                        </p>
                    @else
                        <p class="text-xs text-slate-500 italic mt-2">
                            Sin descripción registrada.
                        </p>
                    @endif
                </div>

                <!-- Acciones (RF5: Eliminar con comprobación previa) -->
                <div class="mt-5 pt-4 border-t border-slate-800/80 flex items-center justify-between">
                    <a href="{{ route('libros.index', ['categoria_id' => $categoria->id]) }}" 
                       class="text-xs font-medium text-blue-400 hover:text-blue-300 transition">
                        Ver obras asociadas →
                    </a>

                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Seguro que deseas eliminar la categoría «{{ addslashes($categoria->nombre) }}»?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-2.5 py-1 rounded-lg text-xs font-semibold text-rose-300 hover:bg-rose-950/40 border border-rose-800/30 transition"
                                {{ $categoria->libros_count > 0 ? 'title=Tiene_obras_asociadas' : '' }}>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
