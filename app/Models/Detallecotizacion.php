<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallecotizacion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    // protected $primaryKey = 'idmedida';
    protected $table ='detallecotizacions';

    protected $fillable = [
        'id_cotizacion',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];
     public $timestamps = false;
}
