<?php
// aca van las rutas
// voy a usar PATIENTS
// voy a usar BLOODjPEOPLE
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Patient;
use App\Blood;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function(){ // autenticacion

});

// RUTA DEFAULT
Route ::get('/', function(){
    return redirect()->route('patients');
});

// MOSTRADO DE TODOS LOS PACIENTES
Route ::get('patients', function(){
    $patients = Patient::join('bloods', 'patients.blood_id', '=', 'bloods.blood_id')
                ->select('patients.*', 'bloods.group', 'bloods.factor')
                ->OrderBy('dni','asc')
                ->get();

    return view('patients.patients', compact('patients'));
})->name('patients'); // le da un nombre a la ruta

// MOSTRADO DE FORMULARIO PARA CREAR PACIENTE
Route ::get('patients/new', function(){
    $bloods = Blood::get();
    return view('patients.new', compact('bloods'));
})->name('patients.new');

//CREADO DE PACIENTES
Route ::post('patients', function(Request $request){ // trae en un array toda la informacion del formulario
    $newPatient = new Patient;
    $newPatient->dni = $request->input('dni');
    $newPatient->name = $request->input('name');
    $newPatient->surname = $request->input('surname');
    $newPatient->age = $request->input('age');
    $newPatient->blood_id = $request->input('blood_id');; // sobreescrito para probar
    $newPatient->save();

    return redirect()->route('patients')->with('info','Paciente agregado exitosamente');
    // redirecciona, routea y manda un array de informacion
})->name('patients.store');

// BORRADO DE PACIENTES
Route ::delete('patients/{patient_id}', function($patient_id){
    $patient = Patient::findOrFail($patient_id); // por alguna razon no me deja usar findorfail
    $patient->delete();
    // primero se busca y despues se ejecutan ordenes

    return redirect()->route('patients')->with('info','Paciente eliminado exitosamente');
    // redirecciona, routea y manda un array de informacion
})->name('patients.delete');


// MOSTRADO DE FORMULARIO DE EDICION
Route ::get('patients/{patient_id}/edit', function($patient_id){

    $patient =  Patient::join('bloods', 'patients.blood_id', '=', 'bloods.blood_id')
                ->select('patients.*', 'bloods.group', 'bloods.factor')
                ->OrderBy('dni','asc')
                ->findOrFail($patient_id);
    // first retorna un solo obj , vendria a ser el equivalente al get()
    $bloods = Blood::get();
    return view('patients.edit', compact('patient'), compact('bloods'));// va entre comillas y sin $
})->name('patients.edit');


// EDITADO DE PRODUCTO
Route::put('patients/{patient_id}', function(Request $request, $patient_id){

    $patient =  Patient::join('bloods', 'patients.blood_id', '=', 'bloods.blood_id')
                ->select('patients.*', 'bloods.group', 'bloods.factor')
                ->OrderBy('dni','asc')
                ->findOrFail($patient_id);
    $patient->dni = $request->input('dni');
    $patient->name = $request->input('name');
    $patient->surname = $request->input('surname');
    $patient->age = $request->input('age');
    $patient->save();

    return redirect()->route('patients')->with('info','Paciente editado exitosamente');
})->name('patients.update');
