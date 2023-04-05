<?php

use Src\Route;

Route::add('POST', '/login', [Controller\Api::class, 'login']);
