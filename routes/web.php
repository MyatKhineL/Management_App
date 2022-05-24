<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HomeController;



\Illuminate\Support\Facades\Auth::routes();

Route::middleware('auth')->group(function (){
      Route::get('/',[PageController::class,'home'])->name('home');
      Route::resource('employee',EmployeeController::class);
      Route::get('/employee/datatable/ssd',[EmployeeController::class,'ssd']);
      Route::get('Profile',[ProfileController::class,'profile'])->name('profile');

    Route::resource('department',DepartmentController::class);
    Route::get('/department/datatable/ssd',[DepartmentController::class,'ssd']);


    Route::resource('role',RoleController::class);
    Route::get('/role/datatable/ssd',[RoleController::class,'ssd']);

    Route::resource('permission',PermissionController::class);
    Route::get('/permission/datatable/ssd',[PermissionController::class,'ssd']);

});



