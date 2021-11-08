<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    //Nos sirve para proteger nuestra base de datos y solo se llenan los campos indicados
    protected $fillable = ['nombre', 'precio', 'stock'];
}
