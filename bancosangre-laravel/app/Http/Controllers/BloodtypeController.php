<?php

namespace App\Http\Controllers;

use App\Bloodtype;
use App\Patient;
use Illuminate\Http\Request;

class BloodtypeController extends Controller
{
    //
    public function getBloodtypes(){
        $nombrePagina = 'Tipos de Sangre';
        return view('bloodtypes.bloodtypes', compact('nombrePagina'));
    }

    public function showNewForm(){
        $nombrePagina= 'Nuevo tipo de sangre';
        return view('bloodtypes.new', compact('nombrePagina'));
    }

    public function newBloodtype(Request $request){ // trae en un array toda la informacion del formulario
        $validatedData = $request->validate([
            'group' => 'required',
            'factor' => 'required'
        ]);
        
        $newBlood = new Bloodtype;
        $newBlood->group = $request->input('group');
        $newBlood->factor = $request->input('factor');
        $newBlood->save();
    
        return redirect()->route('bloodtypes')->with('info','Tipo de sangre agregado exitosamente');
        // redirecciona, routea y manda un array de informacion
    }

    public function deleteBloodtype($blood_id){
        $blood = Bloodtype::findOrFail($blood_id); // por alguna razon no me deja usar findorfail
        $blood->delete();
        // primero se busca y despues se ejecutan ordenes
    
        return redirect()->route('bloodtypes')->with('info','Tipo de sangre eliminado exitosamente');
        // redirecciona, routea y manda un array de informacion
    }

    public function bloodCompatibility($blood_id){
        $nombrePagina= 'Pacientes compatibles';
    
        $patients = Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                    ->select('patients.*', 'bloodtypes.*')
                    ->OrderBy('dni','asc')
                    ->where('patients.blood_id', $blood_id) // hay que especificar sino se rompe
                    ->get();
                    
        return view('bloodtypes.compatiblepatients', compact('patients','nombrePagina'));
    }
}
