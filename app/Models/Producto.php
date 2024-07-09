<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    // protected $primaryKey = 'idmedida';
    protected $table ='productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'id_categoria'
    ];
     public $timestamps = false;
}

