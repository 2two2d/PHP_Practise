<?php

namespace Controller;
error_reporting(E_ERROR | E_PARSE);
use Illuminate\Database\Capsule\Manager as DB;
use Src\Validators\Validator;
use Src\View;
use Model\Post;
use Model\User;
use Model\Department;
use Model\Employee;
use Model\Staff;
use Src\Request;
use Validators\ValidatorRules;

class Admin
{
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
        $validatorRules = new ValidatorRules();

        if($request->method==='POST'){

            $validator = new Validator($request->all(), $validatorRules->employeeRegisterValidationRules
            , $validatorRules->employeeRegisterValidationMessages);

            if($validator->fails()){
                return new View('site.adminOrEmployeeRegister',
                    ['message' => $validator->errors()]);

            }

            $user = User::create($request->all());
            $user->save();
            $employee = Employee::create($request->all());
            $employee->setAva($_FILES['ava'], __DIR__ . '/../../public/Images/');
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
        $validatorRules = new ValidatorRules();

        if($request->method==='POST'){
            $employee = Employee::where('username', $request->username)->first();

            $validator = new Validator($request->all(), $validatorRules->employeeChangeValidationRules, $validatorRules->employeeChangeValidationMessages);

            if($validator->fails()){
                return new View('site.employeeChange',
                    ['employee' => $employee,
                     'departments' => $departments,
                     'staffs' => $staffs,
                     'posts' => $posts,
                     'message' => $validator->errors()]);
            }

            $employee->update(array_slice($request->all(), 0, 11));

            if($_FILES['ava']['tmp_name']){
                $employee->setAva($_FILES['ava'], __DIR__ . '/../../public/Images/');
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
}




