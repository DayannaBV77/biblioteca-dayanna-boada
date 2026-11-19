<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Biblioteca de Dayanna')</title>

    <!-- Tailwind CSS (CDN para interfaz elegante en modo oscuro) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slateDark: '#0F172A',
                        electricBlue: '#2563EB',
                        electricPurple: '#7C3AED',
                        glassBg: 'rgba(30, 41, 59, 0.7)',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
    </style>
</head>
<body class="bg-[#0F172A] text-slate-100 min-h-screen flex flex-col font-sans selection:bg-purple-600 selection:text-white">

    <!-- Encabezado / Barra Superior -->
    <header class="sticky top-0 z-50 glass-panel border-b border-slate-800/80 shadow-xl shadow-slate-950/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3.5">
                <a href="{{ url('/libros') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:scale-105 transition duration-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight bg-gradient-to-r from-blue-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent">
                            Biblioteca de Dayanna
                        </h1>
                        <p class="text-xs text-slate-400">Colección de Alta Literatura & Filosofía</p>
                    </div>
                </a>
            </div>

            <!-- Menú de Navegación -->
            <nav class="flex items-center space-x-2">
                <a href="{{ url('/libros') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request()->is('libros*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/40 shadow-sm shadow-blue-500/20' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                    Libros
                </a>
                <a href="{{ url('/categorias') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request()->is('categorias*') ? 'bg-purple-600/20 text-purple-400 border border-purple-500/40 shadow-sm shadow-purple-500/20' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                    Categorías
                </a>
            </nav>
        </div>
    </header>

    <!-- Contenido Dinámico -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Mensajes Flash de Sesión (RF8) -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl glass-panel border border-emerald-500/30 bg-emerald-950/30 text-emerald-300 flex items-center justify-between shadow-lg shadow-emerald-950/20">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 rounded-xl glass-panel border border-rose-500/30 bg-rose-950/30 text-rose-300 flex items-center justify-between shadow-lg shadow-rose-950/20">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Pie de página Institucional Requerido -->
    <footer class="glass-panel border-t border-slate-800/80 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-slate-300 font-semibold tracking-wide">
                Dayanna Boada Valderrama · Ficha 3478025 · 2026
            </p>
            <p class="text-xs text-slate-500 mt-1">
                Servicio Nacional de Aprendizaje (SENA) — Análisis y Desarrollo de Software (ADSO)
            </p>
        </div>
    </footer>

</body>
</html>