<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;   //importamos el controlador


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//al tratarse de un controlador de recursos (resource controller), la sintaxis cambia y es la siguiente:
//este tipo de controladores ya tiene hasta las rutas integradas, simplemente hace falta conectar con el archivo de rutas.
Route::resource('tasks', TaskController::class);  //tasks es el nombre de la ruta, y TaskController es el controlador que se va a usar.



