<?php

namespace Controller;
error_reporting(E_ERROR | E_PARSE);
use Illuminate\Database\Capsule\Manager as DB;
use Src\Validators\Validator;
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
        $employees = Employee::where('role_id', '<', app()->auth->user()->role_id)->join('user', 'user.username','=','employee.username')->get();
        if(array_key_exists('department',$request->all())){
            $employees = Employee::where('role_id', '<', app()->auth->user()->role_id)->where('department', $request->department)->join('user', 'user.username','=','employee.username')->get();
        }else if(array_key_exists('staff',$request->all())){
            $employees = Employee::where('role_id', '<', app()->auth->user()->role_id)->where('staff', $request->staff)->join('user', 'user.username','=','employee.username')->get();
        }
        $departments = Department::all();
        $staffs = Staff::all();
        $currentDate = date('Ymd', time());
        $evgBirthday = Employee::where('role_id', '<', app()->auth->user()->role_id)->join('user', 'user.username','=','employee.username')->avg('birthday');
        $evgAge = round(($currentDate - $evgBirthday)/10000, 2);
        return new View('site.employees',['employees' => $employees,
                                               'evgAge' => $evgAge,
                                               'evgBirthday' => $evgBirthday,
                                               'departments' => $departments,
                                               'staffs' => $staffs]);
    }

    public function adminRegister(Request $request): string
    {
        if($request->method==='POST'){
            $user = User::create($request->all());
            $user->save();
            $employee = Employee::create($request->all());
            $employee->save();
            app()->route->redirect('/employees');
        }

        $role_id = 2;
        return new View('site.adminOrEmployeeRegister', ['role_id' => $role_id]);
    }

    public function employeeRegister(Request $request): string
    {
        $role_id = 1;
        $departments = Department::all();
        $staffs = Staff::all();
        $posts = Post::all();

        if($request->method==='POST'){

            $validator = new Validator($request->all(), [
                'username' => ['required', 'unique:user,username', 'nospaces'],
                'email' => ['required', 'unique:user,email', 'nospaces', 'email'],
                'password' => ['required', 'password', 'nospaces'],
                'name' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
                'surname' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
                'midlename' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
                'birthday' => ['required',],
                'adress' => ['required'],
                'ava' => ['imgsize', 'isimg']
            ], [
                'required' => 'Пустое поле :field!',
                'unique' => 'Поле :field должно быть уникально!',
                'password' => 'Поле :field должно содержать больше 8 символов!',
                'nospaces' => 'Поле :field не может содержать пробелы!',
                'startswithcapital' => 'Поле :field должно начинаться с заглавной буквы!',
                'onlychars' => 'Поле :field должно содержать только символы кириллицы!',
                'email' => 'Почта должна содержать символ "@"',
                'imgsize' => 'Размер картинки не может превышать 2мб!',
                'isimg' => 'Поддерживаются только картинки "jpeg" и "png"!'
            ]);

            if($validator->fails()){
                return new View('site.adminOrEmployeeRegister',
                    ['message' => $validator->errors()]);
            }

            $user = User::create($request->all());
            $user->save();
            $employee = Employee::create($request->all());

            $imgUniqueName = md5(time()).'.'.explode('/',$_FILES['ava']['type'])[1];
            $employee->ava = $imgUniqueName;
            move_uploaded_file($_FILES['ava']['tmp_name'], __DIR__ . '\..\..\public\\Images\\' . $imgUniqueName);


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
        $departments = Department::all();
        $staffs = Staff::all();
        $posts = Post::all();

        if($request->method==='POST'){
            $employee = Employee::where('username', $request->username)->first();

            $validator = new Validator($request->all(), [
                'name' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
                'surname' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
                'midlename' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
                'birthday' => ['required',],
                'adress' => ['required'],
                'imgsize' => ['Размер картинки не может превышать 2мб!'],
                'isimg' => ['Поддерживаются только картинки "jpeg" и "png"!']
            ], [
                'required' => 'Пустое поле :field!',
                'unique' => 'Поле :field должно быть уникально!',
                'nospaces' => 'Поле :field не может содержать пробелы!',
                'startswithcapital' => 'Поле :field должно начинаться с заглавной буквы!',
                'onlychars' => 'Поле :field должно содержать только символы кириллицы!',
                'imgsize' => 'Размер картинки не может превышать 2мб!',
                'isimg' => 'Поддерживаются только картинки "jpeg" и "png"!'
            ]);

            if($validator->fails()){
                return new View('site.employeeChange',
                    ['employee' => $employee,
                     'departments' => $departments,
                     'staffs' => $staffs,
                     'posts' => $posts,
                     'message' => $validator->errors()]);
            }

            $employee->update($request->all());

            if($_FILES['ava']){
                $imgUniqueName = md5(time()).'.'.explode('/',$_FILES['ava']['type'])[1];
                $employee->ava = $imgUniqueName;
                move_uploaded_file($_FILES['ava']['tmp_name'], __DIR__ . '\..\..\public\\Images\\' . $imgUniqueName);
                $employee->save();
            }

            return new View('site.employeeChange', ['employee' => $employee,
                'departments' => $departments,
                'staffs' => $staffs,
                'posts' => $posts,
                'message' => 'Пользователь был успешно обновлён']);
        }

        return new View('site.employeeChange', ['employee' => $employee,
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




