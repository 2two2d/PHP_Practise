<?php

use Src\Route;
use FastRoute\RouteCollector;

Route::add('GET','/about', [Controller\EmployeeController::class, 'index']);
Route::add('GET','/personal_data', [Controller\EmployeeController::class, 'personalData'])->middleware('auth');
Route::add(['GET', 'POST'],'/employees', [Controller\AdminController::class, 'employees'])->middleware('auth');
Route::add(['GET', 'POST'],'/employee_change', [Controller\AdminController::class, 'employeeChange'])->middleware('auth');
Route::add('GET','/employee_delete', [Controller\AdminController::class, 'employeeDelete'])->middleware('auth');
Route::add(['GET', 'POST'],'/login', [Controller\AuthController::class, 'login']);
Route::add(['GET', 'POST'],'/employee_register', [Controller\AdminController::class, 'employeeRegister'])->middleware('auth');
Route::add(['GET', 'POST'],'/admin_register', [Controller\AdminController::class, 'adminRegister'])->middleware('isroleidthree');
Route::add('GET','/logout', [Controller\AuthController::class, 'logout'])->middleware('auth');