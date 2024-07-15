<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Detallecotizacion;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizacions = Cotizacion::select('cotizacions.*','users.name')
        ->join('users', 'users.id', '=', 'cotizacions.id_cliente')
        ->get();
        return view("cotizacion.index ", compact("cotizacions"));
    }
    public function viewDetalleCotizacion($id){

        $cotizacions = Cotizacion::select('cotizacions.*','users.name')
        ->join('users', 'users.id', '=', 'cotizacions.id_cliente')
        ->where('cotizacions.id', $id)
        ->get();

        $detallecotizacions = Detallecotizacion::select('detallecotizacions.*','productos.nombre')
        ->join('productos','productos.id','=','detallecotizacions.id_producto')
        ->where('detallecotizacions.id_cotizacion', $id)
        ->get();
        return view('cotizacion.detalle', compact('detallecotizacions','cotizacions'));
    }

    public function create()
    {
        $producto = DB::select("SELECT * FROM productos");
        return view("cotizacion.create", compact("producto"));
    }


    public function createCotizacion(Request $request)
    {

        try {
            // return response()->json($request);
            DB::beginTransaction();

            // $codCliente = $request->productos[0]['codCliente'];
            $formattedDate = Carbon::now()->format('Y-m-d');
            $total = $request->productos[0]['total'];


            $saveCotizacion = new Cotizacion();
            // $saveCotizacion->id = 17;
            $saveCotizacion->id_cliente = 7;
            $saveCotizacion->fecha = $formattedDate;
            // $saveCotizacion->total = 13242;
            $saveCotizacion->total = number_format($total, 2);
            $saveCotizacion->estado = "Pendiente";

            $cantidad = count($request->productos);
            //  return response()->json($saveCotizacion);
            if ($saveCotizacion->save()) {

                $idCotizacion = $saveCotizacion->id;
                for ($i = 0; $i < $cantidad; $i++) {

                    $saveDetalle = new Detallecotizacion();

                    $saveDetalle->id_cotizacion = $idCotizacion;
                    $saveDetalle->id_producto = intval($request->productos[$i]['id']);
                    $saveDetalle->cantidad = intval($request->productos[$i]['cantidad']);
                    $saveDetalle->precio_unitario = number_format($request->productos[$i]['precio'], 2);
                    $saveDetalle->subtotal = number_format($request->productos[$i]['subtotal'], 2);

                    if ($saveDetalle->save()) {
                    } else {
                        DB::rollBack();
                        return response()->json(['success' => false, 'message' => 'Error al guardar Detalle cotizacion'], 404);
                    }
                }
            } else {
                // return response()->json($saveCotizacion);
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Error al guardar Cotizacion'], 404);
            }
            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // return response()->json($saveCotizacion);
            DB::rollBack();
            // Manejo del error
            echo "Ocurrió un error al guardar la Cotizacion: " . $e->getMessage();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }
}
