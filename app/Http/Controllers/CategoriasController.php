<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorias = Categoria::all();
        return view('categorias.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|unique:categorias|max:255',
            'color' => 'required|max:7'
        ]);

        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->color = $request->color;
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria Agregada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $categoria = Categoria::find($id);
        return view('categorias.show', ['categoria'=>$categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias|max:255',
            'color' => 'required|max:7'
        ]);
        //
        $categoria= Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->color = $request->color;
        $categoria->save();

         return redirect()->route('categorias.index')->with('success','Categoria Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoria)
    {
        //
        $categoria = Categoria::find($categoria);
        $categoria->tareas()->each(function($tarea){
            $tarea->delete();
        });
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria Eliminada');
    }
}
