@extends('app')

@section('content')

    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categorias.store')}}" method="POST">
                @csrf
    
                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
    
                @error('nombre')
                <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nueva Categoria</label>
                  <input type="text" class="form-control" name="nombre">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la Categoria</label>
                    <input type="color" class="form-control" name="color">
                  </div>
                <button type="submit" class="btn btn-primary">Agrega Categoriar</button>
              </form>
              <div>
                @foreach ($categorias as $categoria)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('categorias.show', ['categoria'=>$categoria->id]) }}" class="d-flex align-items-center gap-2">
                                <span class="color-container" style="background-color:{{ $categoria->color }}"></span> {{ $categoria->nombre }}
                            </a>
                        </div>

                        <div class="col-md-3 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{$categoria->id}}">Eliminar</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-{{$categoria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Si elimina la categoria <strong>{{$categoria->nombre}}</strong> se eliminaran todas las tareas relacionadas a esta. <br>
                                    ¿Seguro desea elimianrla?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form method="POST" action="{{ route('categorias.destroy',['categoria' => $categoria->id]) }}">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
        </div>
    </div>

@endsection