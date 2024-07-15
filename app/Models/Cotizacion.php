<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    // protected $primaryKey = 'idmedida';
    protected $table ='cotizacions';

    protected $fillable = [
        'id_cliente',
        'fecha',
        'total',
        'estado'
    ];
     public $timestamps = false;
}
