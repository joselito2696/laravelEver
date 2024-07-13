<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use stdClass;

class InventarioController extends Controller
{
    public function index()
    {
        return view('inventario.index');
    }


    public function getProductByBarcode($barcode)
    {
        $product = Producto::where('codbarra', $barcode)->first();

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }


    public function createInventario(Request $request)
    {
        // return response()->json($request);
        $codInv = $request->productos[0]['codInv'];
        $inve = Inventario::where('codigoinv', $codInv)->distinct()->first();
        // return response()->json($inve);
        if ($inve) {
            return response()->json(['success' => false,'codinv'=>true], 404);
        } else {
            $cantidadErroneas2 = array();
            $cantidadErroneas=0;
            $tipoMov = $request->productos[0]['tipo'];
            $cantidad = count($request->productos);
            
        
            for ($i = 0; $i < $cantidad; $i++) {
                
        
                $product = Producto::where('id', intval($request->productos[$i]['id']))->first();
                
                $cantidad2 = 0;
                
                if ($tipoMov == "Entrada Inventario") {
                    $cantidad2 = $product->stock + $request->productos[$i]['cantidad'];
                } else {
                    $cantidad2 = $product->stock - $request->productos[$i]['cantidad'];
                }
        
                // Actualizar el stock del producto
                if ($cantidad2 > 0) {
    
                    $formattedDate = Carbon::now()->format('Y-m-d');
                    $saveIn = new Inventario();
                    $saveIn->id_producto = intval($request->productos[$i]['id']);
                    $saveIn->cantidad = $request->productos[$i]['cantidad'];
                    $saveIn->fecha = $formattedDate;
                    $saveIn->tipo_movimiento = "inventario";
                    
                    $saveIn->save();
    
    
                    $modificarprod = Producto::find($request->productos[$i]['id']);
                    $modificarprod->stock = $cantidad2;
                    $modificarprod->save();
                } else {
                    $cantidadErroneas=$cantidadErroneas+1;
                    // Manejar productos con cantidades erróneas
                    $prod = new stdClass();
                    $prod->id = $request->productos[$i]['id'];
                    $prod->nombre = $request->productos[$i]['nombre'];
                    $prod->codigoBarra = $request->productos[$i]['codigoBarra'];
                    $prod->cantidad = $request->productos[$i]['cantidad'];
                     array_push($cantidadErroneas2, $prod);
                }
            }
        
            // Si hay productos erróneos, devolver una respuesta indicando el error
            if ($cantidadErroneas > 0) {
                return response()->json(['success' => false,'codinv'=>false,'body'=>$cantidadErroneas2], 404);
            } else {
                // Si todo fue exitoso, devolver una respuesta de éxito
                return response()->json(['success' => true], 201);
            }
        }
    }
}
