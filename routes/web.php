<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/shiny', function () {
    //return view('shiny');
    //return 'hello shiny';
//});

Route::get('/shiny', [App\Modules\ShinyModule\Http\Controllers\PersonsController::class, 'index']);

Route::get('/persons', [SoftC\Persons\Http\Controllers\PersonController::class, 'index']);