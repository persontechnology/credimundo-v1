<?php

use App\Http\Controllers\CreditoController;
use App\Http\Controllers\CuentaUserController;
use App\Http\Controllers\TipoCreditoController;
use App\Http\Controllers\TipoCuentaController;
use App\Http\Controllers\TipoTransaccionController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    // usuarios
    Route::resource('usuarios', UserController::class);
    Route::get('usuarios/ver-archivo/{id}/{tipo}', [UserController::class,'verArchivo'])->name('usuarios.ver-archivo');
    Route::get('usuarios/descargar-archivo/{id}/{tipo}', [UserController::class,'descargarArchivo'])->name('usuarios.descargar-archivo');

    // tipo de cuentas
    Route::resource('tipo-cuentas', TipoCuentaController::class);
    // cuenta de usuarios
    Route::resource('cuentas-usuario', CuentaUserController::class);
    Route::get('cuentas-usuario/solicitud-apertura-cuenta/{id}',[CuentaUserController::class,'solicitudAperturaCuenta'])->name('cuentas-usuario.solicitud-apertura-cuenta');

    // tipo de transaccion
    Route::resource('tipo-transacciones', TipoTransaccionController::class);
    
    // transaccion
    Route::resource('transacciones', TransaccionController::class);
    Route::get('transacciones/imprimir-recibo/{id}', [TransaccionController::class,'imprimirRecibo'])->name('transacciones.imprimirRecibo');
    Route::get('transacciones/imprimir-comprobante/{id}', [TransaccionController::class,'imprimirComprobante'])->name('transacciones.imprimirComprobante');

    // tipo de crédito
    Route::resource('tipo-creditos', TipoCreditoController::class);

    // creditos
    Route::resource('creditos', CreditoController::class);
    Route::get('creditos/tabla-amortizacion/{id}', [CreditoController::class,'tablaAmortizacion'])->name('creditos.tabla-amortizacion');
    Route::get('creditos/pagare/{id}', [CreditoController::class,'pagare'])->name('creditos.pagare');
    Route::get('creditos/garantes/{id}', [CreditoController::class,'garantes'])->name('creditos.garantes');
    Route::post('creditos/garantes/actualizar', [CreditoController::class,'garantesActualizar'])->name('creditos.garantes-actualizar');

});


require __DIR__.'/auth.php';
