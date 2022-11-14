<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Categoria;

class TareasController extends Controller
{
    /* 
        index para mostrar todos las tareas
        store para guardar una tarea
        update para actualizar una tarea
        destroy para eliminar una tarea
        edit para mostrar el formulario de edicion
    */

    public function store(Request $request){

        $request->validate([
            'titulo' => 'required|min:3'
        ]);

        $tarea = new Tarea;
        $tarea->titulo = $request->titulo;
        $tarea->categoria_id = $request->categoria_id;
        $tarea->save();

        return redirect()->route('tareas')->with('success', 'Tareas creada correctamente');
    }

    public function index() {
       $tareas = Tarea::all();
       $categorias = Categoria::all(); 
       return view('tareas.index', ['tareas' => $tareas, 'categorias' => $categorias]);
    }

    public function show($id) {
        $tarea = Tarea::find($id);
        $categorias = Categoria::all();
        return view('tareas.show', ['tarea' => $tarea, 'categorias' => $categorias]);
    }

    public function update( Request $request, $id) {
        $request->validate([
            'titulo' => 'required|min:3'
        ]);
        
        $tarea = Tarea::find($id);
        $tarea->titulo = $request->titulo;
        $tarea->categoria_id = $request->categoria_id;
        $tarea->save();

        return redirect()->route('tareas')->with('success', 'Tareas Actualizada!');
    }

    public function destroy($id){
        $tarea = Tarea::find($id);
        $tarea->delete();

        return redirect()->route('tareas')->with('success', 'Tarea Eliminada!');
    }
}
