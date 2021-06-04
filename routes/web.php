<?php

use App\Http\Controllers\Catalogos\Alumnos\AlumnosController;
use App\Http\Controllers\Catalogos\Profesores\ProfesorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Storage\ProfileStorageController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
Route::post('login',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

//    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('home',  [HomeController::class, 'index'])->name('home');

    Route::get('editProfile/{Id}',[UserController::class,'editProfile'])->name('editProfile');
    Route::put('updateProfile',[UserController::class,'updateProfile'])->name('updateProfile');
    Route::get('editPasswordUser/{Id}',[UserController::class,'editPasswordUser'])->name('editPasswordUser');
    Route::put('updatePasswordUser',[UserController::class,'updatePasswordUser'])->name('updatePasswordUser');
    Route::get('editFotodUser/{Id}',[UserController::class,'editFotodUser'])->name('editFotodUser');
    Route::post('updateFotodUser',[ProfileStorageController::class,'subirArchivoProfile'])->name('updateFotodUser');

    // ALUMNOS
    Route::get('listaAlumnos/{Id}',[AlumnosController::class,'index'])->name('listaAlumnos');
    Route::get('editAlumno/{Id}',[AlumnosController::class,'editItem'])->name('editAlumno');
    Route::get('removeAlumno/{Id}/{Dato1}/{Dato2}',[AlumnosController::class,'removeItem'])->name('removeAlumno');

    // PROFESORES
    Route::get('listaProfesores/{Id}',[ProfesorController::class,'index'])->name('listaProfesores');
    Route::get('editProfesor/{Id}',[ProfesorController::class,'editItem'])->name('editProfesor');
    Route::get('removeProfesor/{Id}/{Dato1}/{Dato2}',[ProfesorController::class,'removeItem'])->name('removeProfesor');

    // USUARIOS
    Route::get('listaUsuarios/{Id}',[UserController::class,'index'])->name('listaUsuarios');
    Route::get('editUsuario/{Id}',[UserController::class,'editItem'])->name('editUsuario');
    Route::get('removeUsuario/{Id}/{Dato1}/{Dato2}',[AlumnosController::class,'removeItem'])->name('removeUsuario');

/*
    Route::get('editProfilePassword/', 'User\UserController@editProfilePassword')->name('editProfilePassword/');
    Route::put('updateProfilePassword/', 'Catalogos\User\UserDataController@updateProfilePassword')->name('updateProfilePassword/');
    Route::get('editProfilePhoto/', 'Catalogos\User\UserDataController@editProfilePhoto')->name('editProfilePhoto/');
    Route::post('subirFotoProfile/', 'Storage\StorageProfileController@subirArchivoProfile')->name('subirArchivoProfile/');
    Route::get('quitarFotoProfile/', 'Storage\StorageProfileController@quitarArchivoProfile')->name('quitarArchivoProfile/');
*/

});
