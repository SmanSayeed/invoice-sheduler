<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ServiceProviderAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('service-provider/register', [ServiceProviderAuthController::class, 'register']);
Route::post('service-provider/login', [ServiceProviderAuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('clients', [ClientController::class, 'index']);
    Route::get('clients/{id}', [ClientController::class, 'show']);

    Route::get('devices', [DeviceController::class, 'index']);
    Route::get('devices/{id}', [DeviceController::class, 'show']);

    Route::get('clients/{id}/invoices', [InvoiceController::class, 'clientInvoices']);
    Route::get('invoices/{id}', [InvoiceController::class, 'invoiceDetails']);
    Route::post('invoices/generate', [InvoiceController::class, 'generate']);
    Route::post('invoices/{id}/send', [InvoiceController::class, 'sendInvoice']);
// });
