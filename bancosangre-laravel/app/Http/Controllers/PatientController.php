<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function getPatients(){
        $nombrePagina= 'Pacientes';
        $patients = Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                ->OrderBy('dni','asc')
                ->get();

        return view('patients.patients', compact('patients','nombrePagina'));
    }

    public function getPatient($patient_id){
        
        $patient =  Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
            ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
            ->OrderBy('dni','asc')
            ->findOrFail($patient_id);
        $nombrePagina= $patient->name." ".$patient->surname;

        return view('patients.details', compact('patient','nombrePagina'));
    }

    public function deletePatient($patient_id){
        
        $patient = Patient::findOrFail($patient_id); // por alguna razon no me deja usar findorfail
        $patient->delete();
        // primero se busca y despues se ejecutan ordenes

        return redirect()->route('patients')->with('info','Paciente eliminado exitosamente');
    }

    public function showNewForm(){
        $nombrePagina= 'Nuevo Paciente';
        return view('patients.new', compact('nombrePagina'));
    }

    public function newPatient(Request $request){ // trae en un array toda la informacion del formulario
        $validatedData = $request->validate([
            'dni' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'blood_id' => 'required',
        ]);

        
        $newPatient = new Patient;
        $newPatient->dni = $request->input('dni');
        $newPatient->name = $request->input('name');
        $newPatient->surname = $request->input('surname');
        $newPatient->age = $request->input('age');
        $newPatient->phone = $request->input('phone');
        $newPatient->adress = $request->input('adress');
        $newPatient->blood_id = $request->input('blood_id');; // sobreescrito para probar
        $newPatient->save();
    
        return redirect()->route('patients')->with('info','Paciente agregado exitosamente');
        // redirecciona, routea y manda un array de informacion
    }

    public function showEditForm($patient_id){
        $nombrePagina= 'Editar Paciente';
        $patient =  Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                    ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                    ->OrderBy('dni','asc')
                    ->findOrFail($patient_id);
        // first retorna un solo obj , vendria a ser el equivalente al get()

        return view('patients.edit', compact('patient','nombrePagina'));// va entre comillas y sin $
    }

    public function editPatient(Request $request, $patient_id){
        $patient =  Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                ->OrderBy('dni','asc')
                ->findOrFail($patient_id);
        
        $validatedData = $request->validate([
            'dni' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'blood_id' => 'required',
        ]);        

        $patient->dni = $request->input('dni');
        $patient->name = $request->input('name');
        $patient->surname = $request->input('surname');
        $patient->age = $request->input('age');
        $patient->phone=$request->input('phone');
        $patient->adress=$request->input('adress');
        $patient->blood_id = $request->input('blood_id');
        
        $patient->save();

        return redirect()->route('patients')->with('info','Paciente editado exitosamente');
    }
    
}
