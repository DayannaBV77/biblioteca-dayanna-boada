<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Libro extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'libros';

    /**
     * Atributos asignables en masa.
     */
    protected $fillable = [
        'titulo',
        'autor',
        'anio',
        'categoria_id',
        'disponible',
    ];

    /**
     * Conversión nativa de tipos de datos.
     */
    protected $casts = [
        'anio' => 'integer',
        'categoria_id' => 'integer',
        'disponible' => 'boolean',
    ];

    /**
     * Relación inversa: Un libro pertenece a una categoría.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Scope para filtrar por categoría.
     * Regla MVC: Consultas y filtros encapsulados en el modelo.
     */
    public function scopeDeCategoria(Builder $query, ?int $categoriaId): Builder
    {
        if (!empty($categoriaId)) {
            return $query->where('categoria_id', $categoriaId);
        }

        return $query;
    }

    /**
     * Scope para buscar por título (o autor) de forma flexible.
     * Regla MVC: Evitar queries SQL directas en controladores o vistas.
     */
    public function scopeBuscar(Builder $query, ?string $termino): Builder
    {
        if (!empty(trim((string) $termino))) {
            return $query->where(function (Builder $q) use ($termino) {
                $q->where('titulo', 'like', '%' . trim($termino) . '%')
                  ->orWhere('autor', 'like', '%' . trim($termino) . '%');
            });
        }

        return $query;
    }

    /**
     * Scope combinado para búsqueda y filtrado reutilizable.
     */
    public function scopeFiltrar(Builder $query, array $filtros): Builder
    {
        return $query->buscar($filtros['buscar'] ?? null)
                     ->deCategoria($filtros['categoria_id'] ?? null);
    }
}
