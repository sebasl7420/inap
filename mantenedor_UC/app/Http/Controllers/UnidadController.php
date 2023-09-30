<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidad::orderBy('nombre')->simplePaginate(50);
        return view('unidad.index', compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidad::all();
        return view('unidad.create', compact('unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unidad = new Unidad();
        $unidad->nombre = $request->nombre;
        $unidad->sede = $request->sede;
        $unidad->save();

        return redirect(route('unidad'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Unidad $unidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidad $unidad)
    {
        return view('unidad.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unidad $unidad)
    {
      
        $unidad->nombre =  $request->nombre;
        $unidad->sede = $request->sede;
        $unidad->save();

        //redireccion
        return redirect()->route('unidad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidad $unidad)
    {           
        $existePersona = Unidad::where('id', $unidad->id)
        ->whereHas('personas')
        ->exists();
        if ($existePersona) {
            return redirect()->route('unidad.edit', compact('unidad'))->with('error', 'La unidad tiene una o más personas asociadas');
        }
        $unidad->delete();
        return redirect()->route('unidad');
    }

    public function buscarUnidad(Request $request)
    {
        $searchTerm = $request->input('search');
        $unidades = Unidad::where('nombre', 'LIKE', "%$searchTerm%")
                              ->orWhere('sede', 'LIKE', "%$searchTerm%")
                              ->simplePaginate(50);
        return view('unidad.index', compact('unidades'));
    }
}
