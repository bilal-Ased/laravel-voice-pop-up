<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


