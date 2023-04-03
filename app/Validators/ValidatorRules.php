<?php
namespace Validators;

use Src\Validators\AbstractValidator;

class ValidatorRules
{
    public array $employeeRegisterValidationRules = [
    'username' => ['required', 'unique:user,username', 'nospaces'],
    'email' => ['required', 'unique:user,email', 'nospaces', 'email'],
    'password' => ['required', 'password', 'nospaces'],
    'name' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
    'surname' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
    'midlename' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
    'birthday' => ['required',],
    'adress' => ['required'],
    'ava' => ['imgsize', 'isimg']
    ];

    public array $employeeRegisterValidationMessages = [
    'required' => 'Пустое поле :field!',
    'unique' => 'Поле :field должно быть уникально!',
    'password' => 'Поле :field должно содержать больше 8 символов!',
    'nospaces' => 'Поле :field не может содержать пробелы!',
    'startswithcapital' => 'Поле :field должно начинаться с заглавной буквы!',
    'onlychars' => 'Поле :field должно содержать только символы кириллицы!',
    'email' => 'Почта должна содержать символ "@"',
    'imgsize' => 'Размер картинки не может превышать 2мб!',
    'isimg' => 'Поддерживаются только картинки "jpeg" и "png"!'
    ];

    public array $employeeChangeValidationRules = [
        'name' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
        'surname' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
        'midlename' => ['required', 'nospaces', 'startswithcapital', 'onlychars'],
        'birthday' => ['required',],
        'adress' => ['required'],
        'imgsize' => ['Размер картинки не может превышать 2мб!'],
        'isimg' => ['Поддерживаются только картинки "jpeg" и "png"!']
    ];

    public array $employeeChangeValidationMessages = [
        'required' => 'Пустое поле :field!',
        'unique' => 'Поле :field должно быть уникально!',
        'nospaces' => 'Поле :field не может содержать пробелы!',
        'startswithcapital' => 'Поле :field должно начинаться с заглавной буквы!',
        'onlychars' => 'Поле :field должно содержать только символы кириллицы!',
        'imgsize' => 'Размер картинки не может превышать 2мб!',
        'isimg' => 'Поддерживаются только картинки "jpeg" и "png"!'
    ];
}
