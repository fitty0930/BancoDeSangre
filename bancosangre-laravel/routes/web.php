<?php
// aca van las rutas
// voy a usar PATIENTS
// voy a usar BLOODjPEOPLE
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Patient;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// RUTA DEFAULT
Route ::get('/', function(){
    return redirect()->route('patients');
});

// MOSTRADO DE TODOS LOS PACIENTES
Route ::get('patients', function(){
    $patients = Patient::OrderBy('dni','asc')->get(); // trae ordenado por dni, el get es OBLIGATORIO
    return view('patients.patients', compact('patients'));
})->name('patients');

// MOSTRADO DE FORMULARIO PARA CREAR PACIENTE
Route ::get('patients/new', function(){
    return view('patients.new');
})->name('patients.new');

//CREADO DE PACIENTES
Route ::post('patients', function(Request $request){
    $newPatient = new Patient;
    $newPatient->dni = $request->input('dni');
    $newPatient->name = $request->input('name');
    $newPatient->surname = $request->input('surname');
    $newPatient->blood_id = 5; // sobreescrito para probar
    $newPatient->save();

    return redirect()->route('patients')->with('info','Paciente agregado exitosamente');
})->name('patients.store');

// BORRADO DE PACIENTES
Route ::delete('patients/{patient_id}', function($patient_id){
    $patient = Patient::where('patient_id', $patient_id); // por alguna razon no me deja usar findorfail
    $patient->delete();
    
    return redirect()->route('patients')->with('info','Paciente eliminado exitosamente');
})->name('patients.delete');
