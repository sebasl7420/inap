<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Producto;
use App\Models\Persona;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\mysqli;
use Illuminate\Support\Facades\Auth;


class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicituds = Solicitud::orderby('fecha_emision')->simplePaginate(50);//select * from solicituds order by fecha_emision
        return view('solicitud.index', compact('solicituds'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Acceder al objeto del usuario autenticado
            $user = Auth::user();
            // Acceder al nombre de usuario
            $username = $user->username;
            
            $persona = Persona::where('rut', $username)->first();;
            $dependencia = $persona->unidad->sede;
            
            $categorias = Categoria::all();
            //productos de la depencencia
            $productos  = Producto::where('dependencia', $dependencia)->orderBy('categoria_id')->get();
            $productoslist = Producto::where('dependencia', $dependencia)->orderBy('categoria_id')->simplePaginate(50);
            return view('solicitud.create',compact('productos','categorias','productoslist','dependencia'));
        } else {
            return "Usuario no autenticado.";
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $solicitud = new Solicitud();
        $solicitud->json = $request->json;
        $solicitud->json_original = $request->json;
        $solicitud->fecha_emision = date('Y-m-d H:i:s');// Muestra la fecha y hora actual formateada como 'YYYY-MM-DD HH:MM:SS'
        $solicitud->estado = 'P';
        //pasar el id del username
        $persona = Persona::where('rut', $request->user)->first();
        if ($persona) {
            // Aquí guardarás el ID en una variable o donde desees.
            $personaId = $persona->id;
        } else {
            // Manejo de caso cuando no se encuentra el registro con el RUT proporcionado.
            // Puedes mostrar un mensaje de error o realizar alguna acción específica.
        }
        $solicitud->persona_id = $personaId;
        $solicitud->save();
        
        $json = $request->json;
        $data = json_decode($json);// Decodificamos el JSON para obtener un array de objetos
        $ids = array();// Creamos un array para almacenar solo los ids
        foreach ($data as $item) {// Recorremos cada objeto y extraemos el id
            // Asumiendo que la estructura del id es "id":"valor"
            // Podemos usar explode() para separar el id y quedarnos con la parte que nos interesa
            $id_parts = explode(':', $item->id);
            $solicitud->productos()->attach($id_parts[0]);
        }
        
        $solicituds = Solicitud::where('persona_id', $personaId)->orderby('fecha_emision')->get();
        return view('historial.index', compact('solicituds'));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {  
        
        $jsonData = $solicitud->json;
        $dataArray = json_decode($jsonData, true);
        $ids = array();

        foreach ($dataArray as $item) {
            if (isset($item['id'])) {
                $parts = explode(":", $item['id']);
                $number = $parts[0];
                $ids[] = $number;
            }
        }
        
        // Ahora $ids contiene los números extraídos de los atributos "id"
        $productos = Producto::whereIn('id', $ids)->get();

        return view('solicitud.show', compact('solicitud','productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        $jsonData = $solicitud->json;
        $dataArray = json_decode($jsonData, true);
        $ids = array();

        foreach ($dataArray as $item) {
            if (isset($item['id'])) {
                $parts = explode(":", $item['id']);
                $number = $parts[0];
                $ids[] = $number;
            }
        }
        
        // Ahora $ids contiene los números extraídos de los atributos "id"
        $productos = Producto::whereIn('id', $ids)->get();
        return view('solicitud.edit',compact('solicitud','productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $jsonData = $solicitud->json;
        $dataArray = json_decode($jsonData, true);
        $ids = array();
        foreach ($dataArray as $item) {
            if (isset($item['id'])) {
                $parts = explode(":", $item['id']);
                $number = $parts[0];
                $ids[] = $number;
            }
        }
        $productos = Producto::whereIn('id', $ids)->get();


        if ($request->estado=='A'){
            //----------------SOLICITUD APROBADA ---------------
            $json = $request->json;
            $items = json_decode($json, true);
            foreach ($items as $item) {
                // Obtén el producto por su id
                $producto = Producto::where('id', $item['id'])->first();
                // Realiza la operación de resta en el stock
                if ($producto) {
                    $cantidadRestar = $item['cant'];
                    if ($producto->stock_empaque < $cantidadRestar) {
                        $cantidadRestar = $producto->stock_empaque; // Ajustamos la cantidad a restar al stock disponible
                        $mensajeAdvertencia = "La cantidad solicitada supera el stock disponible.";
                        return redirect()->route('solicitud.show', compact('solicitud','productos'))->with('error', $mensajeAdvertencia);
                        
                    }else{
                        $producto->stock_empaque -= $cantidadRestar;
                        $producto->save();
                    }
                }  
            }
            $solicitud->estado = $request->estado;
            $solicitud->save();
            $mensaje="solicitud Aprobada";
            return redirect()->route('solicitud.show', compact('solicitud','productos'))->with('error', $mensaje);

        }elseif($request->estado=='M'){
            //---------------- SOLICITUD MODIFICADA ---------------
            $solicitud->json = $request->json;
            $solicitud->motivo = $request->motivo;
            $solicitud->save();
            $mensaje="solicitud Modificada";
            return redirect()->route('solicitud.show', compact('solicitud','productos'))->with('error', $mensaje);

        }elseif($request->estado=='R'){
            //---------------- SOLICITUD RECHAZADA ------------------
            $solicitud->estado = $request->estado;
            $solicitud->save();
            $mensaje="solicitud Rechazada";
            return redirect()->route('solicitud.show', compact('solicitud','productos'))->with('error', $mensaje);
        }else {
            return redirect()->route('solicitud.show', compact('solicitud','productos'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();
        return redirect()->route('inicio');
    }

    public function ObtenerProductos($json)
    {
        $jsonData = $json;
        $dataArray = json_decode($jsonData, true);
        $ids = array();
        foreach ($dataArray as $item) {
            if (isset($item['id'])) {
                $parts = explode(":", $item['id']);
                $number = $parts[0];
                $ids[] = $number;
            }
        }
        $productos = Producto::whereIn('id', $ids)->get();
        return($produtos);
    }

    public function buscarSolicitud(Request $request)
    {
        $searchTerm = $request->input('search');
        $solicituds = Solicitud::where('id', 'LIKE', "%$searchTerm%")
                              ->simplePaginate(50);
        return view('solicitud.index', compact('solicituds'));
    }
}
