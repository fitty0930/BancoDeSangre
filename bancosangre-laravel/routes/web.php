<?php
// aca van las rutas
// voy a usar PATIENTS
// voy a usar BLOODjPEOPLE
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Patient;
use App\Bloodtype;
use App\User;
use App\Role;
use App\Role_user;
use App\Donation;


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

// Route::apiResource('observations', 'ObservationController');


// MOSTRAR ROLES
Route ::get('roles', function(){
    $nombrePagina="roles";
    $admin=1;
    $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->select('users.*', 'role_user.*')
                // ->OrderBy('dni','asc')
                ->get();

    return view('roles.allroles', compact('users','nombrePagina','admin'));
})->middleware('auth', 'role:admin')->name('roles');

// EDITADO DE ROL
Route::get('roles/{id}', function($id){
    $role_user =  Role_user::select('role_user.*')->where('role_user.user_id', $id)->first();
    if($role_user->role_id==1){
        $role_user->role_id= 2;
        $role_user->save();
    }else if($role_user->role_id==2){
        $role_user->role_id= 1;
        $role_user->save();
    }
    return redirect()->route('roles');
})->middleware('auth', 'role:admin')->name('roles.change');

Route::middleware('auth')->group(function(){ // autenticacion
    Route::get('observations',function(){
        $nombrePagina = 'Observaciones y avisos';
        return view('observations.observations', compact('nombrePagina'));
    })->name('observations');

    // route('bloods')
    Route::get('bloodtypes',function(){
        $nombrePagina = 'Tipos de Sangre';
        return view('bloodtypes.bloodtypes', compact('nombrePagina'));
    })->name('bloodtypes');
    
    // MOSTRADO DE FORMULARIO PARA CREAR PACIENTE
    Route ::get('patients/new', 'PatientController@showNewForm')->name('patients.new');

    //CREADO DE PACIENTES
    Route ::post('patients', 'PatientController@newPatient')->name('patients.store');

    // EFECTUAR UNA DONACION DE SANGRE
    Route ::post('patients/donate/{patient_id}', function($patient_id){
        $patient =  Patient::findOrFail($patient_id);
        
        $newDonator= new Donation;
        $newDonator->dni=$patient->dni;
        $newDonator->surname= $patient->surname;
        $newDonator->name= $patient->name;
        $newDonator->age=$patient->age;
        $newDonator->save();

        return redirect()->route('patients')->with('info','Donacion exitosa');
    })->name('patients.donate');
});

// MOSTRADO DE TODAS LAS DONACIONES
Route ::get('donations', function(){
    $nombrePagina= 'Pacientes';
    $donations = Donation::get();

    return view('donations.donations', compact('donations','nombrePagina'));
})->name('donations'); // le da un nombre a la ruta


// MOSTRADO DE FORMULARIO PARA CREAR TIPO DE SANGRE
Route ::get('bloodtypes/new', function(){
    $nombrePagina= 'Nuevo tipo de sangre';
    return view('bloodtypes.new', compact('nombrePagina'));
})->middleware('auth', 'role:admin')->name('bloodtypes.new');

//CREADO DE TIPO DE SANGRE
Route ::post('bloodtypes', function(Request $request){ // trae en un array toda la informacion del formulario
    $newBlood = new Bloodtype;
    $newBlood->group = $request->input('group');
    $newBlood->factor = $request->input('factor');
    $newBlood->save();

    return redirect()->route('bloodtypes')->with('info','Tipo de sangre agregado exitosamente');
    // redirecciona, routea y manda un array de informacion
})->middleware('auth', 'role:admin')->name('bloodtypes.store');

// RUTA DE ERROR
Route ::get('error', function(){
    $nombrePagina= 'Error';
    return view('error.error', compact('nombrePagina'));;
})->name('error');;

// RUTA DEFAULT
Route ::get('/', function(){
    return redirect()->route('patients');
});

// MOSTRADO DE TODOS LOS PACIENTES
Route ::get('patients', 'PatientController@getPatients')
->name('patients'); // le da un nombre a la ruta


// BORRADO DE PACIENTES
Route ::delete('patients/{patient_id}', 'PatientController@deletePatient')
->middleware('auth', 'role:admin')->name('patients.delete');


// MOSTRADO DE FORMULARIO DE EDICION
Route ::get('patients/{patient_id}/edit', 'PatientController@showEditForm')
->middleware('auth', 'role:admin')->name('patients.edit');


// EDITADO DE PACIENTE
Route::put('patients/{patient_id}', 'PatientController@editPatient')
->middleware('auth', 'role:admin')->name('patients.update');

// DETALLES DE UN SOLO PACIENTE
Route::get('patients/{patient_id}','PatientController@getPatient')
->name('patients.details');

// BORRADO DE TIPO DE SANGRE
Route ::delete('bloodtypes/{blood_id}', function($blood_id){
    $blood = Bloodtype::findOrFail($blood_id); // por alguna razon no me deja usar findorfail
    $blood->delete();
    // primero se busca y despues se ejecutan ordenes

    return redirect()->route('bloodtypes')->with('info','Tipo de sangre eliminado exitosamente');
    // redirecciona, routea y manda un array de informacion
})->middleware('auth', 'role:admin')->name('bloodtypes.delete');

// FILTRADO DE PACIENTES POR TIPO DE SANGRE (COMPATIBILIDAD)
Route::get('bloodtypes/{blood_id}/compatibility', function($blood_id){
    $nombrePagina= 'Pacientes compatibles';

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
