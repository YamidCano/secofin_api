<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arl extends Model
{
    use HasFactory;
    // Especificar el nombre de la tabla
    protected $table = 'arl';
    protected $guarded = [];
}
