<?php
// aca van las rutas
// voy a usar PATIENTS
// voy a usar BLOODjPEOPLE
use Illuminate\Support\Facades\Route;

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
    return 'Esta es la url raiz';
});

Route ::get('patients', function(){
    return view('patients.patients');
})->name('patients');

Route ::get('patients/new', function(){
    return view('patients.new');
})->name('patients.new');
