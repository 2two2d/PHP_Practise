<?php

use Src\Route;

Route::add('about', [Controller\Site::class, 'index']);
Route::add('personal_data', [Controller\Site::class, 'personalData']);
Route::add('employees', [Controller\Site::class, 'employees']);
Route::add('login', [Controller\Site::class, 'login']);
Route::add('employee_register', [Controller\Site::class, 'employeeRegister']);
Route::add('employee_change', [Controller\Site::class, 'employeeChange']);
Route::add('admin_register', [Controller\Site::class, 'adminRegister']);
Route::add('logout', [Controller\Site::class, 'logout']);
