@extends('layouts.app')

@section('title', 'Nueva Categoría · Biblioteca de Dayanna')

@section('content')
<div class="max-w-xl mx-auto space-y-6">

    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2">
                <span>🏷️</span> Crear Categoría
            </h2>
            <p class="text-sm text-slate-400 mt-0.5">Registra una nueva clasificación temática para la colección.</p>
        </div>
        <a href="{{ route('categorias.index') }}" class="text-sm text-slate-400 hover:text-white transition">
            ← Volver a categorías
        </a>
    </div>

    <div class="glass-panel p-6 sm:p-8 rounded-2xl">
        <form method="POST" action="{{ route('categorias.store') }}" class="space-y-5">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                    Nombre de la Categoría <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       value="{{ old('nombre') }}" 
                       placeholder="Ej. Teología y Mística"
                       class="w-full bg-slate-900/90 border {{ $errors->has('nombre') ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-700/80' }} rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition">
                @error('nombre')
                    <p class="text-xs text-rose-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                    Descripción / Alcance (Opcional)
                </label>
                <textarea name="descripcion" 
                          id="descripcion" 
                          rows="4" 
                          placeholder="Breve reseña sobre el tipo de obras que agrupa esta categoría temática..."
                          class="w-full bg-slate-900/90 border {{ $errors->has('descripcion') ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-700/80' }} rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-xs text-rose-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de Acción -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('categorias.index') }}" 
                   class="px-4 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 shadow-lg shadow-purple-500/25 transition">
                    Guardar Categoría
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
