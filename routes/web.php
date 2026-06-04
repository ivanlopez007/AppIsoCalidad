<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalidadController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//Pagina de promocion
Route::get('/', function () {
    return view('index');
})->name('index');


//'auth'
Route::middleware([],)->controller(AuthController::class)->prefix('auth')->group(function (){

    // Route::get('/', 'dashboard')->name('admin.dashboard'),
    Route::get('login', 'showLogin')->name('admin.login');
    Route::post('login', 'login')->name('admin.login.post');

    Route::get('/usuarios', 'getUsuarios')->name('admin.usuarios');
    Route::get('/', 'configuracion')->name('admin.configuracion');
    
    // Route::resource('/documento', )->name('document')
});


Route::middleware([])->controller(CalidadController::class)->prefix('calidad')->group(function(){

    Route::get('/usuarios', 'getUsuarios')->name('calidad.usuarios');



});


Route::get('crear-usuario', function(){
    return view('crear_usuario');
})->name('crear_usuario');

Route::get('/dashboard', function(){
    return view('layout/layout');
})->name("layout");


Route::get('/usuario', function(){
    return view('usuarios');
})->name("usuarios");

Route::get('/configuracion', function(){
    return view('configuracion');
})->name("configuracion");