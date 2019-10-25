<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checador extends Model
{
    protected $table = 'checador';
    protected $fillable = ['numero', 'nombre', 'fecha_hora', 'registro', 'dispositivo'];
    protected $dates = ['fecha_hora'];
    public $timestamps = false;
}
