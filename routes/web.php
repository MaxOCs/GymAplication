<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [CategoriaController::class, 'login']);


Route::get('/registro', [CategoriaController::class, 'registro']);


Route::get('/frases', [CategoriaController::class, 'Frases']);

Route::get('/getEjercicios', [CategoriaController::class, 'getEjercicios']);
Route::get('/registroIMC/{usuarioF}', [CategoriaController::class, 'registroIMC']);

Route::get('/userIngresado/{nombre}', [CategoriaController::class, 'userIngresado']);

Route::get('/HistorialIMC/{idUsuario}', [CategoriaController::class, 'HistorialIMC']);

Route::get('/foto/{nombre}', [CategoriaController::class,'obtenerFotoPerfil']);


Route::get('/transformacion', [CategoriaController::class,'fotoTransformacion']);
Route::post('/guardarfoto', [CategoriaController::class, 'guardarfoto']);


Route::get('/count-ejercicios/{entrenamientoId}', [CategoriaController::class, 'countEjerciciosPorEntrenamiento']);


Route::get('/entrenamiento/{nivel}/{tipo}', [CategoriaController::class, 'obtenerIDEntrenamiento']);




Route::get('/transformacion', [CategoriaController::class,'fotoTransformacion']);

Route::post('/guardarfoto', [CategoriaController::class, 'guardarfoto']);

 