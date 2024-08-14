<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Filtrar los ítems y categorías por el usuario autenticado
        $userId = Auth::id();

        // Contar solo los ítems y categorías que pertenecen al usuario autenticado
        $totalItems = Item::where('user_id', $userId)->count();
        $totalCategorias = Categoria::where('user_id', $userId)->count();

        // Obtener los ítems recientes, también filtrados por usuario
        $recentItems = Item::with('categoria')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('totalItems', 'totalCategorias', 'recentItems'));
    }
}
