<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderBy('nombre_categoria')->simplePaginate(50);
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('categoria.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre_categoria =  $request->nombre;
        $categoria->save();
        return redirect(route('categoria'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //Editar datos
        $categoria->nombre_categoria =  $request->nombre;
        $categoria->save();

        //redireccion
        return redirect()->route('categoria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $existeProducto = Categoria::where('id', $categoria->id)
        ->whereHas('productos')
        ->exists();
        if ($existeProducto) {
            return redirect()->route('categoria.edit', compact('categoria'))->with('error', 'La categoria tiene uno o más productos asociadas');
        }
        $categoria->delete();
        return redirect()->route('categoria');
    }

    public function buscarCategoria(Request $request)
    {
        $searchTerm = $request->input('search');
        $categorias = Categoria::where('nombre_categoria', 'LIKE', "%$searchTerm%")
                              ->simplePaginate(50);
        return view('categoria.index', compact('categorias'));
    }
}
