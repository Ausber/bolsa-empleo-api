<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Oferta extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'nombre_oferta',
        'estado'
    ];
}
