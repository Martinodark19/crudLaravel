<?php

use App\Http\Controllers\crudController;
use App\Http\Controllers\formController;
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
    return view('index');
});

// ruta para procesar formulario
route::post('/form',[formController::class,'getDataForm']);

//ruta para mostrar boton si existen usuarios
route::get('/showUser',[formController::class,'existUsers']);

//ruta para mostrar usuarios
route::get('/users',[formController::class,'showUsersView']);


// rutas para realizar operaciones CRUD
route::post('/delete',[crudController::class,'delete']);
route::get('/edit',[crudController::class,'edit']);
route::post('/edit/update',[crudController::class,'updateUsers']);

