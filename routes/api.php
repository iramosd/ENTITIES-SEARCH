<?php

use App\Http\Controllers\EntityController;
use Illuminate\Support\Facades\Route;

Route::get('/entities', EntityController::class)->name('api.entities');
