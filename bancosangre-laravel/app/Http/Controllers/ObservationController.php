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
        // ESTO ES LO QUE FALLA
        $observation = new Observation();
        $observation->name = $request->input('name'); // ESTO ES LO QUE FALLA
        $observation->content = $request->input('content');

        $observation->save();

        // return json_encode($observation); // borrar esto despues
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $observation = Observation::findOrFail($id);
        $observation->delete();
        
    }
}
