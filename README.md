# Biblioteca de Dayanna

Sistema web de gestión bibliográfica desarrollado bajo el marco del programa **Análisis y Desarrollo de Software (ADSO)** del SENA (Ficha: **3478025**).

---

## 🏛️ Identidad Obligatoria del Proyecto
- **Autora:** Dayanna Boada Valderrama
- **Ficha:** 3478025
- **Año:** 2026
- **Carpeta del proyecto:** `biblioteca-dayanna-boada`
- **Repositorio:** `biblioteca-mvc-dayanna-boada`
- **Base de datos:** `biblioteca_dayanna_boada`
- **Encabezado principal:** `Biblioteca de Dayanna`
- **Pie de página oficial:** `Dayanna Boada Valderrama · Ficha 3478025 · 2026`
- **Estilo visual:** Modo oscuro con fondo `#0F172A`, detalles en azul eléctrico, morado y efecto glassmorphism.

---

## 📐 Arquitectura de Software y Reglas MVC

El proyecto sigue una separación rigurosa del patrón Modelo-Vista-Controlador:

1. **Rutas (`routes/web.php`):** Actúan exclusivamente como enrutadores entre URLs, verbos HTTP (`GET`, `POST`, `PUT`, `DELETE`) y métodos de controladores (`LibroController`, `CategoriaController`). Prohibido colocar closures con consultas o lógica de negocio.
2. **Modelos (`app/Models/`):**
   - Modelos Eloquent `Categoria` y `Libro`.
   - Propiedad `$fillable` explícita para evitar asignación masiva vulnerable.
   - Relaciones ORM bien definidas: `Categoria::hasMany(Libro::class)` y `Libro::belongsTo(Categoria::class)`.
   - Scopes reutilizables para búsquedas y filtros combinados.
   - Verificaciones de integridad referencial antes de eliminar.
3. **Controladores (`app/Http/Controllers/`):**
   - Controladores delgados: reciben peticiones HTTP, validan entradas, delegan en los modelos y devuelven respuestas HTTP (vistas o redirecciones con mensajes flash `session`).
   - Sin sentencias SQL crudas ni código HTML embebido.
4. **Vistas Blade (`resources/views/`):**
   - Layout maestro `resources/views/layouts/app.blade.php`.
   - Vistas modularizadas para libros y categorías.
   - Prohibido hacer consultas o instanciar modelos dentro de las plantillas.

---

## 🚀 Requisitos de Ejecución
- PHP 8.2+ (con extensiones `pdo`, `xml`, `mbstring`)
- Composer
- Motor de base de datos MySQL/MariaDB o SQLite (`biblioteca_dayanna_boada`)
