<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Muestra un listado de todas las categorías.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (!Auth::check()) {
            return view('categorias.index', ['categorias' => collect(), 'message' => 'No hay categorías disponibles']);
        }
      
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Muestra los ítems pertenecientes a una categoría específica.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function items($id)
    {
        $categoria = Categoria::with('items')->findOrFail($id);
        return view('categorias.items', compact('categoria'));
    }
}
