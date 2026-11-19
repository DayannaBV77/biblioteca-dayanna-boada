<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'categorias';

    /**
     * Atributos asignables en masa.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Relación uno a muchos: Una categoría tiene muchos libros.
     */
    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class, 'categoria_id');
    }

    /**
     * Encapsula la lógica de negocio para validar si la categoría puede eliminarse.
     * Regla MVC: La verificación de integridad reside en el modelo.
     */
    public function tieneLibrosAsociados(): bool
    {
        return $this->libros()->exists();
    }
}
