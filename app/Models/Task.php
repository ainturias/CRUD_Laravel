<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //esto fue lo que se añadio para evitar el error de seguridad al guardar los datos en la base de datos.
    //este error viene de la funcion store() del controlador TaskController.php
    protected $fillable = ['title', 'description', 'due_date', 'status'];
}
