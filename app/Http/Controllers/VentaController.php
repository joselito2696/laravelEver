<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        return view('venta.index');
    }

    public function searchCliente($idCliente)
    {



        $clientes = User::select('users.id', 'users.ci', 'users.apellidomaterno', 'apellidopaterno')
            ->join('clientes', 'clientes.id', '=', 'users.id')
            ->where('users.id', $idCliente)
            ->distinct()
            ->first();
        if ($clientes) {
            return response()->json($clientes);
        } else {
            return response()->json(['message' => 'users not found'], 404);
        }
    }
}
