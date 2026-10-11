<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/clients/export', [ClientController::class, 'export'])
    ->name('clients.export');

Route::resource('clients', ClientController::class);
