<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;  //para poder redirigir a otra pagina (nuevo de laravel 10)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::latest()->get();  //aqui estamos obteniendo todos los datos de la base de datos, y los estamos ordenando por fecha de creacion (latest())

        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()  //sirve para mostrar el formulario de la vista que vamos a mostrar
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */

    //aqui va la logica para guardar los datos en la base de datos
    public function store(Request $request): RedirectResponse //el tipo de retorno es para poder redirigir a otra pagina (nuevo de laravel 10)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);


        //dd(request()->all()); //aqui estamos recibiendo todos los datos del formulario

        //aqui estamos creando un nuevo registro en la base de datos.
        Task::create($request->all());  //si hacemos esto puede ocurrir un error de seguridad, ya que se pueden enviar datos que no queremos que se guarden en la base de datos.
        //para evitar esto, en el modelo Task.php, en la propiedad $fillable, añadimos los campos que queremos que se guarden en la base de datos.
        return redirect()->route('tasks.index'); //con esto redirigimos a la pagina principal
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

     //se va a encargar de mostrar el formulario de edicion
    public function edit(Task $task) //aqui estamos recibiendo el id de la tarea que queremos editar
    {
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */

    //aqui vamos a tener la logica para actualizar los datos en la base de datos 
    public function update(Request $request, Task $task): RedirectResponse  //aqui estamos recibiendo el id de la tarea que queremos actualizar
    {
        //dd($request->all());
        //aqui va la validacion de los datos
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $task->update($request->all());  //aqui estamos actualizando los datos en la base de datos
        return redirect()->route('tasks.index')->with('success', 'Actualizado Exitosamente');  //con esto redirigimos a la pagina principal
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();  //aqui estamos eliminando los datos de la base de datos
        return redirect()->route('tasks.index')->with('success', 'Elminado Exitosamente');  //con esto redirigimos a la pagina principal
    }
}
