<?php
// aca van las rutas
// voy a usar PATIENTS
// voy a usar BLOODjPEOPLE
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Patient;
use App\Bloodtype;

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
    // route('bloods')
    Route::get('bloodtypes',function(){
        $nombrePagina = 'Tipos de Sangre';
        return view('bloodtypes.bloodtypes', compact('nombrePagina'));
    })->name('bloodtypes');
    
    // MOSTRADO DE FORMULARIO PARA CREAR PACIENTE
    Route ::get('patients/new', function(){
    $nombrePagina= 'Nuevo Paciente';
    
    return view('patients.new', compact('nombrePagina'));
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

    // MOSTRADO DE FORMULARIO PARA CREAR TIPO DE SANGRE
    Route ::get('bloodtypes/new', function(){
    $nombrePagina= 'Nuevo tipo de sangre';
    return view('bloodtypes.new', compact('nombrePagina'));
    })->name('bloodtypes.new');

    //CREADO DE TIPO DE SANGRE
    Route ::post('bloodtypes', function(Request $request){ // trae en un array toda la informacion del formulario
    $newBlood = new Bloodtype;
    $newBlood->group = $request->input('group');
    $newBlood->factor = $request->input('factor');
    $newBlood->save();

    return redirect()->route('bloodtypes')->with('info','Tipo de sangre agregado exitosamente');
    // redirecciona, routea y manda un array de informacion
    })->name('bloodtypes.store');
    
});



// RUTA DEFAULT
Route ::get('/', function(){
    return redirect()->route('patients');
});

// MOSTRADO DE TODOS LOS PACIENTES
Route ::get('patients', function(){
    $nombrePagina= 'Pacientes';
    $patients = Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                ->OrderBy('dni','asc')
                ->get();

    return view('patients.patients', compact('patients','nombrePagina'));
})->name('patients'); // le da un nombre a la ruta


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
    $nombrePagina= 'Editar Paciente';
    $patient =  Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                ->OrderBy('dni','asc')
                ->findOrFail($patient_id);
    // first retorna un solo obj , vendria a ser el equivalente al get()

    return view('patients.edit', compact('patient','nombrePagina'));// va entre comillas y sin $
})->name('patients.edit');


// EDITADO DE PACIENTE
Route::put('patients/{patient_id}', function(Request $request, $patient_id){

    $patient =  Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                ->OrderBy('dni','asc')
                ->findOrFail($patient_id);

    $patient->dni = $request->input('dni');
    $patient->name = $request->input('name');
    $patient->surname = $request->input('surname');
    $patient->age = $request->input('age');
    $patient->blood_id = $request->input('blood_id');
    $patient->save();

    return redirect()->route('patients')->with('info','Paciente editado exitosamente');
})->name('patients.update');

// DETALLES DE UN SOLO PACIENTE
Route::get('patients/{patient_id}', function($patient_id){
    
    $patient =  Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.group', 'bloodtypes.factor')
                ->OrderBy('dni','asc')
                ->findOrFail($patient_id);
    $nombrePagina= $patient->name." ".$patient->surname;

    return view('patients.details', compact('patient','nombrePagina'));
})->name('patients.details');

// BORRADO DE TIPO DE SANGRE
Route ::delete('bloodtypes/{blood_id}', function($blood_id){
    $blood = Bloodtype::findOrFail($blood_id); // por alguna razon no me deja usar findorfail
    $blood->delete();
    // primero se busca y despues se ejecutan ordenes

    return redirect()->route('bloodtypes')->with('info','Tipo de sangre eliminado exitosamente');
    // redirecciona, routea y manda un array de informacion
})->name('bloodtypes.delete');

// FILTRADO DE PACIENTES POR TIPO DE SANGRE (COMPATIBILIDAD)

Route::get('bloodtypes/{blood_id}/compatibility', function($blood_id){
    $nombrePagina= 'Pacientes compatibles';

    // FALLA
    $patients = Patient::join('bloodtypes', 'patients.blood_id', '=', 'bloodtypes.blood_id')
                ->select('patients.*', 'bloodtypes.*')
                ->OrderBy('dni','asc')
                ->where('patients.blood_id', $blood_id) // hay que especificar sino se rompe
                ->get();
                
    return view('bloodtypes.compatiblepatients', compact('patients','nombrePagina'));
})->name('bloodtypes.compatiblepatients');

// VIEW COMPOSER
// SIRVE PARA PASAR INFORMACION A TODAS LAS VISTAS
View::composer(['*'], function ($view) {
    $bloodtypes = Bloodtype::get();
    $view->with('bloodtypes', $bloodtypes);
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
