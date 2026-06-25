<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalidadController;
use App\Http\Controllers\PreferenciaUsuarioController;
use App\Notifications\CorreoPruebaNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//Pagina de promocion
Route::get('/', function () {
    return view('index');
})->name('index');
//funciona


Route::get('/dashboard', function () {
    return view('layout.layout');
})->middleware([])->name('dashboard');
//funciona




//'auth'
Route::middleware([],)->controller(AuthController::class)->prefix('auth')->group(function () {
    // Route::get('/', 'dashboard')->name('admin.dashboard'),
    Route::get('login', 'showLogin')->name('auth.login');
    Route::post('login', 'login')->name('auth.login.post');
    Route::post('logout', 'logout')->name('auth.logout');
    // Route::resource('/documento', )->name('document')
});





//'auth'
Route::middleware([],)->controller(PreferenciaUsuarioController::class)->group(function () {

    Route::post('/preferencias/tema', 'updateTema')->name('preferencias.updateTema');
    Route::post('/preferencias/idioma', 'updateIdioma')->name('preferencias.updateIdioma');

    Route::get('/preferencias/configuracion',   'showConfiguracion')->name('preferencias.showConfiguracion');
    Route::post('/preferencias/configuracion',  'actualizarConfiguracion')->name('preferencias.actualizarConfiguracion');
});





Route::middleware([])->controller(AdminController::class)->prefix('admin')->group(function () {

    Route::get('/dashboard', 'dashboard')->name('admin.dashboard');

    Route::get('/usuarios',         'showUsuarios')->name('admin.usuarios');

    
    
    
    
    //Rutas de usuarios


    Route::get('/aprobacion',       'aprobacion')->name('admin.aprobacion');

    Route::get('crear-usuario',     'showCrearUsuario')->name('admin.crear_usuario');
    Route::post('crear-usuario',    'crearUsuario')->name('admin.crear_usuario.post');

    Route::get('editar-usuario/{id}', 'showEditarUsuario')->name('admin.editar_usuario');
    Route::post('editar-usuario/{id}', 'updateUsuario')->name('admin.editar_usuario.post');

    Route::get('eliminar-usuario/{id}', 'eliminarUsuario')->name('admin.eliminar_usuario');
    Route::post('eliminar-usuario/{id}', 'eliminarUsuarioPost')->name('admin.eliminar_usuario.post');



    Route::get('/solicitar-cambio', 'solicitarCambio')->name('admin.solicitar_cambio');
    Route::get('/historial', 'historial')->name('admin.historial');
    Route::get('/formato', 'formato')->name('admin.formato');
});





Route::middleware([])->controller(CalidadController::class)->prefix('calidad')->group(function () {

    Route::get('/usuarios', 'getUsuarios')->name('calidad.usuarios');
});




//Prueba de correo
Route::get('/probar-correo', function () {
    $correoDestino = 'ivanalejandro.lopez07@gmail.com'; // Aquí pones el correo real/ficticio

    Notification::route('mail', $correoDestino)->notify(new CorreoPruebaNotification('Iván López'));

    return '¡Notificación enviada a Mailtrap!';
});
