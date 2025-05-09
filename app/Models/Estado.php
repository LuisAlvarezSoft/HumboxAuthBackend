<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Este modelo Estado representa un estado en la base de datos
class Estado extends Model{
    // La tabla asociada al modelo
    protected $table = 'estados';
    // Los campos que son asignables
    protected $fillable = ['name', 'description'];
}
