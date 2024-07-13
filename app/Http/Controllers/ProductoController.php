<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductoController extends Controller
{
    public function index()
    {
        $producto = DB::select("SELECT productos.*,categorias.nombre  as categoria FROM productos,categorias where productos.id_categoria=categorias.id");
        $categoria = DB::select("SELECT * FROM categorias");
        return view('producto.index', compact('producto', 'categoria'));
    }

    public function createProducto(Request $request)
    {
        $prod = DB::select("SELECT count(*) as countcprod FROM productos where nombre='" . $request->nombre . "'");
        //  dd($request->descripcion);
        if ($prod[0]->countcprod == 0) {
            $saveProd = new Producto();
            $saveProd->nombre = $request->nombre;
            $saveProd->descripcion = $request->descripcion;
            $saveProd->precio = $request->precio;
            $saveProd->id_categoria = $request->categoria;
            if ($saveProd->save()) {
                // Buscar::store($request->get('descripcion') ,'promocion','/promocion');
                return redirect()->to('producto')->with('msj', 'Se Registro exitosamente');
            } else {
                return redirect()->to('producto')->with('msj', 'Error al Guardar');
            }
        } else {
            return redirect()->to('producto')->with('msj', 'Ya se guardo Anteriormente');
        }
    }


    public function modificarProducto($idProducto)
    {
        // $this->addPageViews();
        $producto = DB::select("SELECT productos.*,categorias.nombre  as categoria FROM productos,categorias where productos.id_categoria=categorias.id and productos.id=" . $idProducto);
        // dd($producto);
        $categoria = DB::select("SELECT * FROM categorias");
        return view('producto.edit', compact('producto', 'categoria'));
    }
    public function updateProducto(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $modificarprod = Producto::find($id);
        $modificarprod->nombre = $request->get('nombre');
        $modificarprod->descripcion = $request->get('descripcion');
        $modificarprod->precio = $request->get('precio');
        $modificarprod->id_categoria = $request->get('categoria');
        $modificarprod->save();
        return redirect()->to('producto')
            ->with('msj', 'Se modifico exitosamente');
    }

    public function eliminarProducto($id)
    {

        try {
            $eliminarProd = Producto::find($id);
            $eliminarProd->delete();
            return redirect()->to('producto')
                ->with('msj', 'Se elimino exitosamente');
        } catch (Throwable $e) {
            return redirect()->to('producto')
                ->with('msj', 'Error al eliminar');
        }
    }

    
}
