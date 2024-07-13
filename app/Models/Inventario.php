<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    // protected $primaryKey = 'idmedida';
    protected $table ='inventarios';

    protected $fillable = [
        'id_producto',
        'cantidad',
        'fecha',
        'tipo_movimiento'
    ];
     public $timestamps = false;
}
