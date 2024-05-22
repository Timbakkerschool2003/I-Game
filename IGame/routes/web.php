<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IgameController;


Route::get('/', function () {
    return view('welcome');

});

Route::get('/home', function () {
    return view('home');
});


Route::get('/igame', [IgameController::class, 'index']);
Route::post('/igame/update', [IgameController::class, 'update'])->name('igame.update');
