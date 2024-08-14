<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Definir los atributos que pueden ser asignados masivamente
    protected $fillable = ['nombre', 'categoria_id', 'user_id'];

    /**
     * Relación con el modelo User
     * Un ítem pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el modelo Categoria
     * Un ítem pertenece a una categoría
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
