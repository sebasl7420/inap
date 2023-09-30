<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjusteController extends Controller
{
    protected $table = 'productos';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        return view('ajuste.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productos = Producto::all();
   
        $archivo = $request->file('archivo');
       
        if ($archivo) {            
            // Guardar el archivo en la carpeta pública
            $archivo->move(public_path('uploads'), $archivo->getClientOriginalName());
            $ajuste->factura =  $archivo->getClientOriginalName();
        }

        //captura request y guardado
        $ajuste = new Ajuste();
        $ajuste->tipo_ajuste = $request->movimiento;
        $ajuste->fecha_ajuste = date('Y-m-d H:i:s');;
        $ajuste->cantidad_ajuste =  ($request->stock * $request->unidad);
        $ajuste->motivo_ajuste =  $request->motivo;
        $ajuste->producto_id =  $request->producto;
        
        // Capturar la cantidad del ajuste desde el formulario
        $totalstock= ($request->stock * $request->unidad);
        $cantidadAjuste  =  $totalstock;
        // Verificar el tipo de movimiento (ingreso o salida) y actualizar la cantidad del producto
        $producto = Producto::where('id', $request->producto)->first();
        if ($request->movimiento == "ingreso") {
            $producto->stock_empaque += $cantidadAjuste; // Sumar la cantidad al stock actual del producto
        } else {
            if ($cantidadAjuste > $producto->stock_empaque) {
                //return mensaje de error
                return view('ajuste.create', compact('productos'))->with('error', 'El ajuste no se realizo');
            }
            $producto->stock_empaque -= $cantidadAjuste; // Restar la cantidad del stock actual del producto
        }
        // Guardar el producto y ajuste actualizado
        $producto->save();
        $ajuste->save();

        return view('ajuste.create', compact('productos'))->with('error', 'El ajuste se realizo correctamente');
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Ajuste $ajuste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
