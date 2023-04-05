<?php

use Src\Route;
use FastRoute\RouteCollector;

Route::add('GET','/about', [Controller\EmployeeSite::class, 'index']);
Route::add('GET','/personal_data', [Controller\EmployeeSite::class, 'personalData'])->middleware('auth');
Route::add(['GET', 'POST'],'/employees', [Controller\Admin::class, 'employees'])->middleware('auth');
Route::add(['GET', 'POST'],'/employee_change', [Controller\Admin::class, 'employeeChange'])->middleware('auth');
Route::add('GET','/employee_delete', [Controller\Admin::class, 'employeeDelete'])->middleware('auth');
Route::add(['GET', 'POST'],'/login', [Controller\AuthSite::class, 'login']);
Route::add(['GET', 'POST'],'/employee_register', [Controller\Admin::class, 'employeeRegister'])->middleware('auth');
Route::add(['GET', 'POST'],'/admin_register', [Controller\Admin::class, 'adminRegister'])->middleware('isroleidthree');
Route::add('GET','/logout', [Controller\AuthSite::class, 'logout'])->middleware('auth');