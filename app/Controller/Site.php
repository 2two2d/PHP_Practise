<?php

namespace Controller;
error_reporting(E_ERROR | E_PARSE);
use Illuminate\Database\Capsule\Manager as DB;
use Src\Auth\Auth;
use Src\View;
use Model\Post;
use Model\User;
use Model\Department;
use Model\Employee;
use Model\Staff;
use Src\Request;

class Site
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

    public function employees(Request $request): string
    {
        $employees = Employee::where('role_id', 1)->join('user', 'user.username','=','employee.username')->get();
        return new View('site.employees',['employees' => $employees]);
    }

    public function adminRegister(Request $request): string
    {
        $role_id = 2;
        return new View('site.adminOrEmployeeRegister', ['role_id' => $role_id]);
    }

    public function employeeRegister(Request $request): string
    {
        $role_id = 1;
        $departments = Department::all();
        $staffs = Staff::all();
        $posts = Post::all();

        if($_POST['register']){
            $user = User::create([
                'role_id' => $_POST['role_id'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ]);
            $user->save();
            $employee = Employee::create([
                'username' => $_POST['username'],
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'midlename' => $_POST['midlename'],
                'birthday' => $_POST['birthday'],
                'sex' => $_POST['sex'],
                'adress' => $_POST['adress'],
                'department' => $_POST['department'],
                'staff' => $_POST['staff'],
                'post' => $_POST['post'],
            ]);
            $employee->save();
            app()->route->redirect('/employees');
        }

        return new View('site.adminOrEmployeeRegister', ['departments' => $departments,
            'staffs' => $staffs,
            'posts' => $posts,
            'role_id' => $role_id]);
    }

    public function employeeChange(Request $request): string
    {
        $employee = Employee::where('username', $request->username)->first();
        $user = User::where('username', $request->username)->first();
        $departments = Department::all();
        $staffs = Staff::all();
        $posts = Post::all();


        return new View('site.employeeChange', ['employee' => $employee,
            'user' => $user,
            'departments' => $departments,
            'staffs' => $staffs,
            'posts' => $posts]);
    }

    public function employeeDelete(Request $request): string
    {
        $employee = Employee::where('username', $request->username)->first();
        Employee::where('username', $request->username)->delete();
        User::where('username', $request->username)->delete();
        return new View('site.employeeDeleted', ['employee' => $employee]);
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/personal_data');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/about');
    }

}




