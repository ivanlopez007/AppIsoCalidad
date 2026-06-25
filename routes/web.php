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
})->middleware(['auth'])->name('dashboard');
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



    //Rutas para la gestión de usuarios
    Route::get('/usuarios',         'showUsuarios')->name('admin.usuarios');
    Route::get('crear-usuario',         'showCrearUsuario')->name('admin.crear_usuario');
    Route::post('crear-usuario',        'crearUsuario')->name('admin.crear_usuario.post');
    Route::get('editar-usuario/{id}',   'showEditarUsuario')->name('admin.editar_usuario');
    Route::put('editar-usuario/{id}',  'updateUsuario')->name('admin.editar_usuario.put');
    Route::delete('eliminar-usuario/{id}', 'eliminarUsuario')->name('admin.eliminar_usuario.delete');


    // Agregar, borrar o editar documentos
    Route::get('/solicitar-cambio', 'showSolicitarCambio')->name('admin.solicitar_cambio');
    Route::post('/solicitar-cambio', 'solicitarCambio')->name('admin.solicitar_cambio.post');

    
    Route::get('/revision', 'showRevisionSolicitudes')->name('admin.revision');
    Route::get('/aprobacion',       'showAprobacion')->name('admin.aprobacion');

    Route::post('/revision/aprobar/{id}', 'aprobarSolicitud')->name('admin.revision.aprobar');
    Route::post('/revision/rechazar/{id}', 'rechazarSolicitud')->name('admin.revision.rechazar');
    Route::post('/descargar-pdf/{id}', 'descargarPdf')->name('admin.revision.descargar_pdf');

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
