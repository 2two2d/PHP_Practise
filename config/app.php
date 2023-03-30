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
        'email' => \Validators\EmailValidator::class
    ]
];



