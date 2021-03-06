<?php

use App\Http\Controllers\Catalogos\Alumnos\AlumnosController;
use App\Http\Controllers\Catalogos\Familias\FamiliasController;
use App\Http\Controllers\Catalogos\Profesores\ProfesorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Storage\ProfileStorageController;
use App\Http\Controllers\Storage\StorageExternalFilesController;
use App\Http\Controllers\Storage\StorageListaCatalogosController;
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
    Route::put('updateAlumno',[AlumnosController::class,'updateItem'])->name('updateAlumno');
    Route::get('removeAlumno/{Id}/{Dato1}/{Dato2}',[AlumnosController::class,'removeItem'])->name('removeAlumno');

    // PROFESORES
    Route::get('listaProfesores/{Id}',[ProfesorController::class,'index'])->name('listaProfesores');
    Route::get('editProfesor/{Id}',[ProfesorController::class,'editItem'])->name('editProfesor');
    Route::get('removeProfesor/{Id}/{Dato1}/{Dato2}',[ProfesorController::class,'removeItem'])->name('removeProfesor');

    // fAMILIAS
    Route::get('listaFamilias',[FamiliasController::class,'index'])->name('listaFamilias');
    Route::get('newFamilia',[FamiliasController::class,'newItem'])->name('newFamilia');
    Route::post('createFamilia/',[FamiliasController::class,'createItem'])->name('createFamilia');
    Route::get('editFamilia/{Id}',[FamiliasController::class,'editItem'])->name('editFamilia');
    Route::put('updateFamilia/',[FamiliasController::class,'updateItem'])->name('updateFamilia');
    Route::get('removeFamilia/{Id}/{Dato1}/{Dato2}',[FamiliasController::class,'removeItem'])->name('removeFamilia');
    Route::get('getFamiliasnameNext/{Abreviatura}',[FamiliasController::class,'getFamiliasnameNext'])->name('getFamiliasnameNext');
    Route::get('viewSearchModal',[FamiliasController::class,'viewSearchModal'])->name('viewSearchModal');

    // USUARIOS
    Route::get('listaUsuarios',[UserController::class,'index'])->name('listaUsuarios');
    Route::get('newUsuario',[UserController::class,'newItem'])->name('newUsuario');
    Route::post('createUsuario/',[UserController::class,'createItem'])->name('createUsuario');
    Route::get('editUsuario/{Id}',[UserController::class,'editItem'])->name('editUsuario');
    Route::put('updateUsuario/',[UserController::class,'updateItem'])->name('updateUsuario');
    Route::get('removeUsuario/{Id}/{Dato1}/{Dato2}',[UserController::class,'removeItem'])->name('removeUsuario');
    Route::get('getUsernameNext/{Abreviatura}',[UserController::class,'getUsernameNext'])->name('getUsernameNext');
    Route::get('viewSearchModal',[UserController::class,'viewSearchModal'])->name('viewSearchModal');


    // ARCHIVOS

    Route::get('archivos_config',[StorageExternalFilesController::class,'archivos_config'])->name('archivos_config');
    Route::post('subirArchivoBase', [StorageExternalFilesController::class,'subirArchivoBase'])->name('subirArchivoBase');
    Route::get('quitarArchivoBase/{driver}/{archivo}', [StorageExternalFilesController::class,'quitarArchivoBase'])->name('quitarArchivoBase');

    // MS EXCEL

    Route::get('listUsuariosToXlsx',[StorageListaCatalogosController::class,'listUsuariosToXlsx'])->name('listUsuariosToXlsx');
    Route::get('listFamiliasToXlsx',[StorageListaCatalogosController::class,'listFamiliasToXlsx'])->name('listFamiliasToXlsx');



/*
    Route::get('editProfilePassword/', 'User\UserController@editProfilePassword')->name('editProfilePassword/');
    Route::put('updateProfilePassword/', 'Catalogos\User\UserDataController@updateProfilePassword')->name('updateProfilePassword/');
    Route::get('editProfilePhoto/', 'Catalogos\User\UserDataController@editProfilePhoto')->name('editProfilePhoto/');
    Route::post('subirFotoProfile/', 'Storage\StorageProfileController@subirArchivoProfile')->name('subirArchivoProfile/');
    Route::get('quitarFotoProfile/', 'Storage\StorageProfileController@quitarArchivoProfile')->name('quitarArchivoProfile/');
*/




});
