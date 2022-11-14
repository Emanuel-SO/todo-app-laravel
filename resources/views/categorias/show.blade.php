@extends('app')

@section('content')

    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categorias.update',['categoria' => $categoria->id])}}" method="POST">
                @method('PATCH')
                @csrf
    
                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
    
                @error('nombre')
                <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nueva Categoria</label>
                  <input type="text" class="form-control" name="nombre" value="{{ $categoria->nombre}}">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la Categoria</label>
                    <input type="color" class="form-control" name="color" value="{{ $categoria->color }}">
                  </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
              </form>
              <div>
                @if ($categoria->tareas->count() >= 1)
                    @foreach ($categoria->tareas as $tarea)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('tareas-edit', ['id'=> $tarea->id]) }}">{{ $tarea->titulo }}</a>
                        </div>

                        <div class="col-md-3 d-flex-justify-items-end">
                            <form action="{{ route('tareas-destroy',[$tarea->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="brn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    No hay para mostrar
                @endif
              </div>
        </div>
    </div>

@endsection