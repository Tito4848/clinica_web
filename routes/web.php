<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
     return view('inicio');
 });

Route::get('principal', function(){
     return view('principal');
});

// Rutas públicas
Route::get('/acercade', function () {
    return view('acercade');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/consultageneral', function () {
    return view('consultageneral');
})->name('servicio.consulta');

Route::get('/cita', function () {
    return view('cita');
})->name('solicitar.cita');

Route::get('/profesionales', function () {
    return view('profesionalexperto');
});

Route::get('/clinica', [ClinicaController::class, 'index'])->name('clinica');

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/recuperar', function () {
    return view('recuperacion');
});

// Rutas protegidas - Doctor
Route::middleware('auth')->group(function () {
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/doctor/calendario', [DoctorDashboardController::class, 'calendario'])->name('doctor.calendario');
    Route::get('/doctor/horas-disponibles', [DoctorDashboardController::class, 'getHorasDisponibles'])->name('doctor.horas-disponibles');
});

// Citas
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
Route::middleware('auth')->group(function () {
    Route::put('/citas/{cita}/estado', [CitaController::class, 'updateEstado'])->name('citas.update-estado');
    Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

// Contacto
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

// Farmacia
Route::get('/farmacia', [FarmaciaController::class, 'index'])->name('farmacia.index');
Route::get('/farmacia/{slug}', [FarmaciaController::class, 'show'])->name('farmacia.show');

// Carrito
Route::get('/farmacia/carrito', [CarritoController::class, 'index'])->name('farmacia.carrito');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::put('/carrito/{carrito}', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/{carrito}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
Route::post('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');

// Pedidos
Route::get('/farmacia/checkout', [PedidoController::class, 'checkout'])->name('farmacia.checkout');
Route::post('/farmacia/pedido', [PedidoController::class, 'store'])->name('farmacia.pedido.store');
Route::get('/farmacia/pedido/{pedido}/confirmacion', [PedidoController::class, 'confirmacion'])->name('farmacia.pedido.confirmacion');
Route::middleware('auth')->group(function () {
    Route::get('/farmacia/mis-pedidos', [PedidoController::class, 'misPedidos'])->name('farmacia.mis-pedidos');
    Route::get('/farmacia/pedido/{pedido}', [PedidoController::class, 'show'])->name('farmacia.pedido.show');
});
