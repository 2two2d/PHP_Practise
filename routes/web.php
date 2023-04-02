<?php

use Src\Route;
use FastRoute\RouteCollector;

Route::add('GET','/about', [Controller\Site::class, 'index']);
Route::add('GET','/personal_data', [Controller\Site::class, 'personalData'])->middleware('auth');
Route::add(['GET', 'POST'],'/employees', [Controller\Site::class, 'employees'])->middleware('auth');
Route::add(['GET', 'POST'],'/employee_change', [Controller\Site::class, 'employeeChange'])->middleware('auth');
Route::add('GET','/employee_delete', [Controller\Site::class, 'employeeDelete'])->middleware('auth');
Route::add(['GET', 'POST'],'/login', [Controller\Site::class, 'login']);
Route::add(['GET', 'POST'],'/employee_register', [Controller\Site::class, 'employeeRegister'])->middleware('auth');
Route::add(['GET', 'POST'],'/admin_register', [Controller\Site::class, 'adminRegister'])->middleware('isroleidthree');
Route::add('GET','/logout', [Controller\Site::class, 'logout'])->middleware('auth');