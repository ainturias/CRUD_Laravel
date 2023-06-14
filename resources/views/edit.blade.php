@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h2>Editar Tarea</h2>
            </div>
            <div>
                <a href="{{ route('tasks.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>

        {{-- si hay errores, los mostramos aquí, por ej: cuando los campos requeridos no son llenados --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <strong>Por las chancas de mi madre!</strong> Algo fue mal..<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            {{-- como es de tipo PUT|PATCH tenemos que truquearlo, ya que esos son usados para APIS y no para web --}}
        <form action="{{ route('tasks.update', $task) }}" method="POST"> {{-- aqui tenemos que fijarnos con el comando para ver las rutas.. --}}
            {{-- cuando enviamos un formulario que no es de tipo GET, laravel nos pide que usemos el token CSRF --}}
            @csrf {{-- esto es un token de seguridad que nos pide laravel para evitar ataques de tipo CSRF --}}

            {{-- como es de tipo PUT|PATCH tenemos que truquearlo, ya que esos son usados para APIS y no para web --}}
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Tarea:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Tarea" value="{{ $task->title }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Descripción:</strong> {{-- recomendable que el name='' sea igual al nombre que tenemos en la base de datos --}}
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Descripción...">{{ $task->description }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Fecha límite:</strong>
                        <input type="date" name="due_date" class="form-control" id="" value={{ $task->due_date }} >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Estado (inicial):</strong>
                        <select name="status" class="form-select" id="">
                            <option value="">-- Elige el status --</option>
                            <option value="Pendiente" @selected("Pendiente" == $task->status) >Pendiente</option>
                            <option value="En Progreso" @selected("En Progreso" == $task->status)>En Progreso</option>
                            <option value="Completada" @selected("Completada" == $task->status)>Completada</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
