@extends('layouts.app')

@section('title', 'Editar Libro · Biblioteca de Dayanna')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2">
                <span>✏️</span> Editar Obra
            </h2>
            <p class="text-sm text-slate-400 mt-0.5">Modifica los detalles bibliográficos de «{{ $libro->titulo }}».</p>
        </div>
        <a href="{{ route('libros.index') }}" class="text-sm text-slate-400 hover:text-white transition">
            ← Volver al catálogo
        </a>
    </div>

    <div class="glass-panel p-6 sm:p-8 rounded-2xl">
        <form method="POST" action="{{ route('libros.update', $libro) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div>
                <label for="titulo" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                    Título de la obra <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="titulo" 
                       id="titulo" 
                       value="{{ old('titulo', $libro->titulo) }}" 
                       class="w-full bg-slate-900/90 border {{ $errors->has('titulo') ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-700/80' }} rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('titulo')
                    <p class="text-xs text-rose-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Autor -->
            <div>
                <label for="autor" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                    Autor(a) <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="autor" 
                       id="autor" 
                       value="{{ old('autor', $libro->autor) }}" 
                       class="w-full bg-slate-900/90 border {{ $errors->has('autor') ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-700/80' }} rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('autor')
                    <p class="text-xs text-rose-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Año de publicación -->
                <div>
                    <label for="anio" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                        Año de Publicación <span class="text-rose-400">*</span>
                    </label>
                    <input type="number" 
                           name="anio" 
                           id="anio" 
                           value="{{ old('anio', $libro->anio) }}" 
                           min="1500" 
                           max="{{ date('Y') }}"
                           class="w-full bg-slate-900/90 border {{ $errors->has('anio') ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-700/80' }} rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <span class="text-[11px] text-slate-400">Rango permitido: 1500 - {{ date('Y') }}</span>
                    @error('anio')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="categoria_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                        Categoría Temática <span class="text-rose-400">*</span>
                    </label>
                    <select name="categoria_id" 
                            id="categoria_id" 
                            class="w-full bg-slate-900/90 border {{ $errors->has('categoria_id') ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-700/80' }} rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id', $libro->categoria_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <p class="text-xs text-rose-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Estado de Disponibilidad -->
            <div class="pt-2">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" 
                           name="disponible" 
                           value="1" 
                           {{ old('disponible', $libro->disponible) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-blue-600 bg-slate-900 border-slate-700 focus:ring-blue-500 focus:ring-offset-slate-900">
                    <span class="text-sm font-medium text-slate-200">
                        Disponible para lectura y consulta en sala
                    </span>
                </label>
                @error('disponible')
                    <p class="text-xs text-rose-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de Acción -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('libros.index') }}" 
                   class="px-4 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-500/25 transition">
                    Actualizar Cambios
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
