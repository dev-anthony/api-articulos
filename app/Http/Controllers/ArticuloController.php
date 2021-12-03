<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardarArticuloRequest;
use App\Models\Articulo; //recuerda importar las clases

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        //return Articulo::all(); //retorna todos los datos de la tabla articulos
        $articulos = Articulo::all();
        return response()->json([
            "error" => false,
            "response" => $articulos
        ], 200); //en 'data' es dondes se van a guardar los articulos en formato json
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarArticuloRequest $request) //el $request es la petición que mandamos desde el front-end y en esa petición es donde van los datos que estamos enviando
    {
        $articulo = Articulo::create($request->all()); //Con el $request->all() es que esatmos obteniendo todos los datos del formulario y con el método 'create' estamos creando esos recursos y lo esatmos guardadno en la variable $articulo

        if(!$articulo){
            return response()->json([
                "error" => true,
                "message" => "Error al crear el articulo"
            ], 400);
        }else {
            return response()->json([
                "error" => false,
                "response" => $articulo
            ], 200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulo::find($id); //con el método 'find' pasando el 'id' que recibimos de la solicitud

        if(!$articulo){
            return response()->json([
                "error" => true,
                "message" => 'El articulo no existe'
            ], 404);
        }else {
            return response()->json([
               "error" => false,
               "response" => $articulo
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuardarArticuloRequest $request, $id)
    {
        //Generate a udpate query
        $articulo = Articulo::find($id);
        // $articulo = Articulo::find($request->query->all(), $id);
/*
        $request->validate([
            'nombre'=>'required',
            'precio'=>'required',
            'stock'=>'required'
        ]);//Validamos los datos que vamos a enviar
*/


        if(!empty($articulo)){//empyty par aarray de objetos
            $articulo->nombre = $request->nombre;
            $articulo->precio = $request->precio;
            $articulo->stock = $request->stock;
            $articulo->save();//add otra validación
            
            return response()->json([
                "error" => false,
                "message" => "El producto se a actualizado correctamente"
            ], 200);
        }else {
            return response()->json([
                "error" => true,
                "message" => "El producto no se pudo actualizar"
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        #Pimera forma de eliminar
        // if(file_exists($articulo)){
        //     unlink($articulo);
            
        // }
        #Segunda fomra de eliminar
        if($articulo){
            $articulo->delete();
            return response()->json([
                "error" => false,
                "message" => "El producto se a eliminado correctamente",
                "response" => $articulo
            ], 200);
    }else {
        return response()->json([
            "error" => true,
            "message" => "El producto no se pudo eliminar"
        ], 400);
        }
    }
}
