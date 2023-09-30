<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Unidad;

class DocumentoController extends Controller
{
    public function index()
    {
        $unidads = Unidad::orderBy('nombre')->get();
        return view('reporte.index', compact('unidads'));
    }

    public function descargarDocumento(Request $request)
    {
        $rut = $request->input('rut');
        
        // Realiza tu consulta a la base de datos
        $results = DB::table('personas')
            ->join('solicituds', 'personas.id', '=', 'solicituds.persona_id')
            ->select('solicituds.id', 'solicituds.json', 'solicituds.fecha_emision', 'personas.rut', 'personas.nombre')
            ->where('personas.rut', '=', $rut)
            ->get();
    
        // Crear el archivo Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Solicitud');
        $sheet->setCellValue('B1', 'Producto');
        $sheet->setCellValue('C1', 'Cantidad');
        $sheet->setCellValue('D1', 'Fecha');
        $sheet->setCellValue('E1', 'Rut');
        $sheet->setCellValue('F1', 'Nombre');
    
        // Llenar los datos
        foreach ($results as $key => $result) {
            $jsonArray = json_decode($result->json, true);
            foreach ($jsonArray as $product) {
                $row = $sheet->getHighestRow() + 1;
                $sheet->setCellValue('A' . $row, $result->id);
                $sheet->setCellValue('B' . $row, $product['id']);
                $sheet->setCellValue('C' . $row, $product['cant']);
                $sheet->setCellValue('D' . $row, $result->fecha_emision);
                $sheet->setCellValue('E' . $row, $result->rut);
                $sheet->setCellValue('F' . $row, $result->nombre);
            }
        }
    
        // Generar y descargar el archivo
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'documento_'. $rut .'.xlsx';
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
    
    
    public function descargarDocumentoUnidad(Request $request)
    {
        $idUnidad = $request->input('unidad');

        // Realiza tu consulta a la base de datos
        $results = DB::table('Unidads')
        ->join('personas', 'personas.unidad_id', '=', 'unidads.id')
        ->join('solicituds', 'solicituds.persona_id', '=', 'personas.id')
        ->select('solicituds.id', 'solicituds.json','solicituds.fecha_emision' , 'unidads.nombre as nombre_unidad', 'personas.rut', 'personas.nombre as nombre_persona')
        ->where('unidads.id', '=', $idUnidad)
        ->get();
       
        // Crear el archivo Excel
        $spreadsheet = new Spreadsheet();
        // ... (llenar el archivo Excel según lo mencionado en la respuesta anterior)
            // Obtener la hoja activa
        $sheet = $spreadsheet->getActiveSheet();
        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Solicitud');
        $sheet->setCellValue('B1', 'Producto');
        $sheet->setCellValue('C1', 'Cantidad');
        $sheet->setCellValue('D1', 'Fecha');
        $sheet->setCellValue('E1', 'Unidad');
        $sheet->setCellValue('F1', 'Rut');
        $sheet->setCellValue('G1', 'Nombre');
        // Llenar los datos
        foreach ($results as $key => $result) {
            $jsonArray = json_decode($result->json, true);
            foreach ($jsonArray as $product) {
                $row = $sheet->getHighestRow() + 1;
                $sheet->setCellValue('A' . $row, $result->id);
                $sheet->setCellValue('B' . $row, $product['id']);
                $sheet->setCellValue('C' . $row, $product['cant']);
                $sheet->setCellValue('D' . $row, $result->fecha_emision);
                $sheet->setCellValue('E' . $row, $result->nombre_unidad);
                $sheet->setCellValue('F' . $row, $result->rut);
                $sheet->setCellValue('G' . $row, $result->nombre_persona);
            }
        }

        // Generar y descargar el archivo
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'documento'.$result->nombre_unidad.'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function descargarDocumentoStock()
    {
        // Realiza tu consulta a la base de datos
        $results = DB::table('productos')
        ->select('id','codigo_producto', 'nombre_producto', 'marca','created_at', 'stock_empaque', 'stock_critico_empaque')
        ->whereRaw('stock_empaque <= stock_critico_empaque')
        ->get();

        // Crear el archivo Excel
        $spreadsheet = new Spreadsheet();
        // ... (llenar el archivo Excel según lo mencionado en la respuesta anterior)
            // Obtener la hoja activa
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Codigo');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Marca/Modelo');
        $sheet->setCellValue('E1', 'Fecha Creacion');
        $sheet->setCellValue('F1', 'Stock Actual');
        $sheet->setCellValue('G1', 'Stock Critico');

        // Llenar los datos
        foreach ($results as $key => $result) {
            $row = $key + 2; // Comenzar en la fila 2 para los datos
            $sheet->setCellValue('A' . $row, $result->id);
            $sheet->setCellValue('B' . $row, $result->codigo_producto);
            $sheet->setCellValue('C' . $row, $result->nombre_producto);
            $sheet->setCellValue('D' . $row, $result->marca);
            $sheet->setCellValue('E' . $row, $result->created_at);
            $sheet->setCellValue('F' . $row, $result->stock_empaque);
            $sheet->setCellValue('G' . $row, $result->stock_critico_empaque);
        }

        // Generar y descargar el archivo
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'documento_Productos_stockCritico.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
}
