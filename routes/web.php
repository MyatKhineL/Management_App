<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;


\Illuminate\Support\Facades\Auth::routes();

Route::middleware('auth')->group(function (){
      Route::get('/',[PageController::class,'home'])->name('home');
});


Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
