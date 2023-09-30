<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $productos = Producto::orderBy('nombre_producto')->paginate(9);
        $productos = Producto::orderBy('nombre_producto')->simplePaginate(50);
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('producto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $codigo = $request->input('codigo');
        // Verificar si el RUT ya existe en la base de datos
        $existeProducto = Producto::where('codigo_producto', $codigo)->exists();
        if ($existeProducto) {
            return redirect()->route('producto.create')->with('error', 'El codigo ya existe en la base de datos.');
        }

        $producto = new Producto();
        $producto->codigo_producto          =  $request->codigo;
        $producto->nombre_producto          =  $request->nombre;
        $producto->marca                    =  $request->model;
        $producto->stock_empaque            =  $request->cantidad;
        $producto->stock_critico_empaque    =  $request->stock_critico;
        $producto->categoria_id             =  $request->categoria;
        $producto->descripcion              =  $request->descripcion;
        $producto->dependencia              =  $request->sede;
 
        $producto->save();

        return redirect(route('producto'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('producto.edit', compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->nombre_producto          =  $request->nombre;
        $producto->stock_critico_empaque    =  $request->stock_critico;
        $producto->categoria_id             =  $request->categoria;
        $producto->descripcion              =  $request->descripcion;
        $producto->marca                    =  $request->model;
        $producto->dependencia              =  $request->sede;

        //guardar en base de datos
        $producto->save();

        //redireccion
        return redirect()->route('producto.show',$producto->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('producto');
    }

    public function buscarProducto(Request $request)
    {
        $searchTerm = $request->input('search');
        $productos = Producto::where('nombre_producto', 'LIKE', "%$searchTerm%")
                              ->orWhere('codigo_producto', 'LIKE', "%$searchTerm%")
                              ->simplePaginate(50);

        return view('producto.index', compact('productos'));
    }

}
