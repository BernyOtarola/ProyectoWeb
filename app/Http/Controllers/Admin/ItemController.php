<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     *
     * @return View
     */
    public function index(): View
    {
        // Filtrar los ítems por el usuario autenticado
        $items = Item::where('user_id', Auth::id())->get();
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item.
     *
     * @return View
     */
    public function create(): View
    {
        // Obtener solo las categorías que pertenecen al usuario autenticado
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('admin.items.form', ['item' => null, 'categorias' => $categorias]);
    }

    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Asignar el user_id del usuario autenticado
        $item = new Item($request->all());
        $item->user_id = Auth::id();
        $item->save();

        return redirect()->route('admin.items.index')->with('success', 'Ítem creado exitosamente.');
    }

    /**
     * Show the form for editing the specified item.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        // Asegurarse de que el ítem pertenezca al usuario autenticado
        $item = Item::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('admin.items.form', compact('item', 'categorias'));
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Asegurarse de que el ítem pertenezca al usuario autenticado
        $item = Item::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->update($request->all());

        return redirect()->route('admin.items.index')->with('success', 'Ítem actualizado exitosamente.');
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Asegurarse de que el ítem pertenezca al usuario autenticado antes de eliminarlo
        $item = Item::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Ítem eliminado exitosamente.');
    }
}
