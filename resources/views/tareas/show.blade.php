@extends('app')

@section('content')

    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('tareas-update',['id' =>$tarea->id]) }}" method="POST">
            @method('PATCH')
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            @error('titulo')
            <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            <div class="mb-3">
              <label for="titulo" class="form-label">Nueva Tarea</label>
              <input type="text" class="form-control" name="titulo" value="{{ $tarea->titulo }}">
            </div>
            <label for="categoria_id" class="form-label">Categoria de la tarea</label>
            <select name="categoria_id" class="form-select">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary my-4">Agregar</button>
          </form>

         
    </div>

@endsection