<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::join('usuarios', 'personas.rut', '=', 'usuarios.username')
                  ->where('usuarios.rol', '=', 2)
                  ->select('personas.*')
                  ->distinct()
                  ->simplePaginate(50);
        return view('persona.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidads = Unidad::all();
        return view('persona.create', compact('unidads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rut = $request->input('rut');
        // Verificar si el RUT ya existe en la base de datos
        $existeCliente = Persona::where('rut', $rut)->exists();
        if ($existeCliente) {
            return redirect()->route('persona.create')->with('error', 'El RUT ya existe en la base de datos.');
        }
        $usuario = new Usuario();
        $usuario->username = $request->rut;
        $seisPrimerosDigitos = substr($request->rut, 0, 6);
        // Hashear los 6 primeros dígitos utilizando bcrypt
        $claveHash = password_hash($seisPrimerosDigitos, PASSWORD_BCRYPT);
        $usuario->password = $claveHash ;
        $usuario->rol = '2';
        $usuario->save();

        $user = Usuario::where('username', $request->rut)->first();
        $persona = new Persona();
        $persona->rut = $request->rut;
        $persona->nombre = $request->nombre;
        $persona->apellido =  $request->apellido;
        $persona->correo=  $request->correo;
        $persona->telefono =  $request->telefono;
        $persona->unidad_id =  $request->unidad;
        $persona->usuario_id = $user->id;
        $persona->save();

        return redirect(route('persona'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        $unidads = Unidad::all();
        return view('persona.edit', compact('persona','unidads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {   
        // $rut = $request->input('rut');
        // // Verificar si el RUT ya existe en la base de datos
        // $existeCliente = Persona::where('rut', $rut)->exists();

        // if ($existeCliente) {
        //     $unidads = Unidad::all();
        //     return redirect()->route('persona.edit', compact('persona','unidads'))->with('error', 'El RUT ya existe en la base de datos.');
        // }

        // $persona->rut = $request->rut;
        $persona->nombre = $request->nombre;
        $persona->apellido =  $request->apellido;
        $persona->correo=  $request->correo;
        $persona->telefono =  $request->telefono;
        $persona->unidad_id =  $request->unidad;
        $persona->save();

        return redirect()->route('persona');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        $usuario= Usuario::where('username', $persona->rut)->first();
        $usuario->delete();
        $persona->delete();
        return redirect()->route('persona');
    }

    public function buscarPersona(Request $request)
    {
        $searchTerm = $request->input('search');
        $personas = Persona::where('nombre', 'LIKE', "%$searchTerm%")
                              ->orWhere('rut', 'LIKE', "%$searchTerm%")
                              ->orWhere('correo', 'LIKE', "%$searchTerm%")
                              ->simplePaginate(50);
        return view('persona.index', compact('personas'));
    }
}