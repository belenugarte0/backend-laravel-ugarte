<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

     // Define los campos que se pueden asignar en masa
     protected $fillable = [
        'placa',
        'capacidad',
        'ancho',
        'largo',
        'color',
        'marca',
        'modelo',
        'image',
        'status'
    ];
}
