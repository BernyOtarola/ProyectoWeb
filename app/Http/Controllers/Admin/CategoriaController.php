<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return View
     */
    public function index(): View
    {
        // Filtrar las categorías por el usuario autenticado
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.categorias.form', ['categoria' => null]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear la categoría y asociarla con el usuario autenticado
        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->user_id = Auth::id(); // Asociar con el usuario autenticado
        $categoria->save();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada con éxito.');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        // Asegurarse de que la categoría pertenezca al usuario autenticado
        $categoria = Categoria::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('admin.categorias.form', compact('categoria'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Asegurarse de que la categoría pertenezca al usuario autenticado
        $categoria = Categoria::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $categoria->update($request->all());

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Asegurarse de que la categoría pertenezca al usuario autenticado antes de eliminarla
        $categoria = Categoria::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
