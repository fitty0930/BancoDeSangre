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

Route ::get('/', function(){
    return redirect()->route('patients');
});

Route ::get('patients', function(){
    return view('patients.patients');
})->name('patients');

Route ::get('patients/new', function(){
    return view('patients.new');
})->name('patients.new');

Route ::post('patients', function(Request $request){
    $newPatient = new Patient;
    $newPatient->dni = $request->input('dni');
    $newPatient->name = $request->input('name');
    $newPatient->surname = $request->input('surname');
    $newPatient->blood_id = 5; // sobreescrito para probar
    $newPatient->save();

    return redirect()->route('patients');
})->name('patients.store');
