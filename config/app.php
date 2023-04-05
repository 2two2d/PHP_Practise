<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity'=>\Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'isroleidthree' => \Middlewares\IsroleidthreeMiddleware::class,
        'isroleidtwo' => \Middlewares\IsroleidtwoMiddleware::class,
    ],
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'password' => \Validators\PasswordValidator::class,
        'nospaces' => \Validators\SpaceValidator::class,
        'startswithcapital' => \Validators\CapitalValidator::class,
        'onlychars' => \Validators\OnlycharsValidator::class,
        'email' => \Validators\EmailValidator::class,
        'imgsize' => \Validators\ImgsizeValidator::class,
        'isimg' => \Validators\IsimgValidator::class,
    ],
    'routeAppMiddleware' => [
        'json' => \Middlewares\JSONMiddleware::class,
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],
    'providers' => [
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ],


];



