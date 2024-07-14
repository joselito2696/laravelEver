<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    // protected $primaryKey = 'idmedida';
    protected $table ='ventas';

    protected $fillable = [
        'id_cliente',
        'fecha',
        'total'
    ];
     public $timestamps = false;
}
