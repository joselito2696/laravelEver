<?php

namespace App\Http\Controllers;

use App\Models\Detalleventa;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::select('ventas.*','users.name')
        ->join('users', 'users.id', '=', 'ventas.id_cliente')
        ->get();
        
        return view('venta.index',compact('ventas'));
    }
    public function viewCrear()
    {
        return view('venta.createVenta');
    }

    public function searchCliente($idCliente)
    {

        $clientes = User::select('users.id', 'users.ci', 'users.name', 'users.apellidomaterno', 'users.apellidopaterno')
            ->join('clientes', 'clientes.id', '=', 'users.id')
            ->where('users.ci', $idCliente)
            ->distinct()
            ->first();
        if ($clientes) {
            return response()->json(['success' => true, 'cliente' => $clientes]);
        } else {
            return response()->json(['success' => false, 'message' => 'users not found'], 404);
        }
    }

    public function createVenta(Request $request)
    {
        try {
            DB::beginTransaction();
            $codCliente = $request->productos[0]['codCliente'];
            $formattedDate = Carbon::now()->format('Y-m-d');
            $total = $request->productos[0]['total'];


            $saveVenta = new Venta();
            $saveVenta->id_cliente = $codCliente;
            $saveVenta->fecha = $formattedDate;
            $saveVenta->total = $total;

            $cantidad = count($request->productos);

            if ($saveVenta->save()) {
                $idVenta = $saveVenta->id;
                for ($i = 0; $i < $cantidad; $i++) {

                    $saveDetalle = new Detalleventa();

                    $saveDetalle->id_venta = $idVenta;
                    $saveDetalle->id_producto = intval($request->productos[$i]['id']);
                    $saveDetalle->cantidad = intval($request->productos[$i]['cantidad']);
                    $saveDetalle->precio_unitario = $request->productos[$i]['precio'];
                    $saveDetalle->subtotal = $request->productos[$i]['subtotal'];
                    if ($saveDetalle->save()) {
                        $modificarprod = Producto::find($request->productos[$i]['id']);
                        $stockReal = $modificarprod->stock - intval($request->productos[$i]['cantidad']);
                        if ($stockReal >= 0) {
                            $modificarprod->stock = $stockReal;
                            if($modificarprod->save()){

                            }else{
                                DB::rollBack();
                                return response()->json(['success' => false, 'message' => 'Error al guardar'. intval($request->productos[$i]['id'])], 404); 
                            }

                        } else {
                            DB::rollBack();
                            return response()->json(['success' => false, 'message' => 'Producto sin stock'. intval($request->productos[$i]['id'])], 404); 
                        }
                    } else {
                        DB::rollBack();
                        return response()->json(['success' => false, 'message' => 'Error al guardar Detalle Venta'], 404);
                    }
                }
                //         'cantidad',
                // 'precio_unitario',
                // 'subtotal'

            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Error al guardar Venta'], 404);
            }




            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            // Manejo del error
            echo "Ocurrió un error al guardar la venta: " . $e->getMessage();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }
}
