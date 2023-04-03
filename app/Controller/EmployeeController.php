<?php

namespace Controller;

use Model\Employee;
use Src\Request;
use Src\View;

class EmployeeController
{
    public function index(Request $request): string
    {
        return (new View())->render('site.about');
    }

    public function personalData(Request $request): string
    {
        $employee = Employee::where('username', app()->auth->user()->username)->first();
        return new View('site.personalData', ['employee' => $employee]);
    }
}