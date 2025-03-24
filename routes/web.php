<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\nylasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/call', [CallController::class, 'show']);
Route::any('/nylas',[nylasController::class,'getContacts']);
// Route::any('/callback',[nylasController::class,'callBack']);



