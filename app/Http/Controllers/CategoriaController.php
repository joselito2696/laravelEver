<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = DB::select("SELECT * FROM categorias");
        return view('categoria.index', compact('categoria'));
    }

    public function createCategoria(Request $request)
    {
        $categoria = DB::select("SELECT count(*) as countcategoria FROM categorias where nombre='" . $request->nombre . "'");
        //  dd($request->descripcion);
        if ($categoria[0]->countcategoria == 0) {
            $saveCategoria = new Categoria();
            $saveCategoria->nombre = $request->nombre;
            $saveCategoria->descripcion = $request->descripcion;
            if ($saveCategoria->save()) {
                // Buscar::store($request->get('descripcion') ,'promocion','/promocion');
                return redirect()->to('categoria')->with('msj', 'Se Registro exitosamente');
            } else {
                return redirect()->to('categoria')->with('msj', 'Error al Guardar');
            }
        } else {
            return redirect()->to('categoria')->with('msj', 'Ya se guardo Anteriormente');
        }
    }
    public function modificarCategoria($idCategoria)
    {
        // $this->addPageViews();
        $categoria = Categoria::find($idCategoria);
        return view('categoria.edit', compact('categoria'));
    }

    public function updateCategoria(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $modificarCategoria = Categoria::find($id);
        $modificarCategoria->nombre = $request->get('nombre');
        $modificarCategoria->descripcion = $request->get('descripcion');
        $modificarCategoria->save();
        return redirect()->to('categoria')
            ->with('msj', 'Se modifico exitosamente');
    }
    public function eliminarCategoria($id)
    {
        $eliminarCategoria = Categoria::find($id);
        $eliminarCategoria->delete();
        return redirect()->to('categoria')
            ->with('msj', 'Se elimino exitosamente');
    }
}
