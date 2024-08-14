<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Definir los atributos que pueden ser asignados masivamente
    protected $fillable = ['nombre', 'user_id'];

    /**
     * Relación con el modelo User
     * Una categoría pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el modelo Item
     * Una categoría puede tener muchos ítems
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
