<?php
// aca van las rutas
// voy a usar PATIENTS
// voy a usar BLOODjPEOPLE
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Bloodtype;
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
Route ::get('roles', 'RolesController@showRoles')
->middleware('auth', 'role:admin')->name('roles');

// EDITADO DE ROL
Route::get('roles/{id}', 'RolesController@changeRole')->middleware('auth', 'role:admin')->name('roles.change');

Route::middleware('auth')->group(function(){ // autenticacion
    Route::get('observations',function(){
        $nombrePagina = 'Observaciones y avisos';
        return view('observations.observations', compact('nombrePagina'));
    })->name('observations');

    // route('bloods')
    Route::get('bloodtypes','BloodtypeController@getBloodtypes')->name('bloodtypes');
    
    // MOSTRADO DE FORMULARIO PARA CREAR PACIENTE
    Route ::get('patients/new', 'PatientController@showNewForm')->name('patients.new');

    //CREADO DE PACIENTES
    Route ::post('patients', 'PatientController@newPatient')->name('patients.store');

    // EFECTUAR UNA DONACION DE SANGRE
    Route ::post('patients/donate/{patient_id}', 'DonationController@patientDonate')->name('patients.donate');
});

// MOSTRADO DE TODAS LAS DONACIONES
Route ::get('donations', 'DonationController@getDonations')->name('donations'); // le da un nombre a la ruta


// MOSTRADO DE FORMULARIO PARA CREAR TIPO DE SANGRE
Route ::get('bloodtypes/new', 'BloodtypeController@showNewForm')
->middleware('auth', 'role:admin')->name('bloodtypes.new');

//CREADO DE TIPO DE SANGRE
Route ::post('bloodtypes', 'BloodtypeController@newBloodtype')
->middleware('auth', 'role:admin')->name('bloodtypes.store');

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
Route ::delete('bloodtypes/{blood_id}', 'BloodtypeController@deleteBloodtype')
->middleware('auth', 'role:admin')->name('bloodtypes.delete');

// FILTRADO DE PACIENTES POR TIPO DE SANGRE (COMPATIBILIDAD)
Route::get('bloodtypes/{blood_id}/compatibility', 'BloodtypeController@bloodCompatibility')
->name('bloodtypes.compatiblepatients');

// VIEW COMPOSER
// SIRVE PARA PASAR INFORMACION A TODAS LAS VISTAS
View::composer(['*'], function ($view) {
    $bloodtypes = Bloodtype::get();
    $view->with('bloodtypes', $bloodtypes);
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
