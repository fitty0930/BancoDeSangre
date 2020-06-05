<?php

namespace App\Http\Controllers;

use App\Observation;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $observation = Observation::all();
        return $observation;
        //Esta función nos devolvera todas las observaciones que tenemos en nuestra BD
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
        $observation = new Observation();
        $observation->name = $request->name;
        $observation->content = $request->content;

        $observation->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function show(Observation $observation)
    {
        //
        $observation = Observation::findOrFail($request->id);
        return $observation;
        //Esta función devolverá los datos de una tarea 
        // que hayamos seleccionado para cargar el formulario con sus datos
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function edit(Observation $observation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $observation = Observation::findOrFail($request->id);

        $observation->name = $request->name;
        $observation->content = $request->content;

        $observation->save();

        return $observation;
        //Esta función actualizará la tarea que hayamos seleccionado
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $observation = Observation::destroy($request->id);
        return $observation;
    }
}
