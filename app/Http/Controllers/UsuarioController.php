<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['login']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $rut)
    {
        // dd($rut);

        //retorna index personas
        // return $userid;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login(Request $request)
    {
        $credenciales= $request->only('username','password');

        if(Auth::attempt($credenciales)){
            $usuarioEncontrado = Usuario::where('username', $credenciales["username"])->get();
            $rolUsuario = $usuarioEncontrado->pluck('rol')->first();
            if($rolUsuario==1){
                return redirect()->route('inicio');
            }elseif($rolUsuario==2){
                return redirect()->route('solicitud.create')->with('usuarioEncontrado', $usuarioEncontrado);
            }
            
        }else{
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
        
    }

}
