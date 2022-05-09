<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EmployeeController;


\Illuminate\Support\Facades\Auth::routes();

Route::middleware('auth')->group(function (){
      Route::get('/',[PageController::class,'home'])->name('home');
      Route::resource('employee',EmployeeController::class);
      Route::get('/employee/datatable/ssd',[EmployeeController::class,'ssd']);
});


Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
