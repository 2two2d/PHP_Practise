<?php
use PHPUnit\Framework\TestCase;
use Controller\Admin;
use Src\Application;
use Src\Request;
use Model\User;
use Model\Employee;
use Src\Settings;

class EmployeeRegisterTest extends TestCase
{
    /**
     * @dataProvider additionProviderEmployeeRegister
     */

    public function testEmployeeRegister(string $httpMethod, array $userData, string $message): void
    {
        //Выбираем занятый логин из базы данных
        if ($userData['username'] === 'username is busy') {
            $userData['username'] = User::get()->first()->username;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new Admin())->employeeRegister($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)User::where('username', $userData['username'])->count());
        //Удаляем созданного пользователя из базы данных
        User::where('username', $userData['username'])->delete();

    }



    public static function additionProviderEmployeeRegister(): array
    {
        return [
            ['POST', ['username' => '', 'email' => '', 'password' => '', 'surname' => '', 'name' => '', 'midlename' => '',
                'sex' => '', 'birthday' => '', 'adress' => ''],
                '<p style="color: red">Пустое поле username!</p>'
            ],
            ['POST', ['username' => 'emp4', 'email' => 'notmax1000qwe@mail.ru', 'password' => 'max123max', 'surname' => 'Макс', 'name' => 'Макс', 'midlename' => 'Макс',
                'sex' => 'м', 'birthday' => '23-10-2004', 'adress' => 'йцуйцуйцуйцу'],
                ''
            ],
            ['POST', ['username' => 'username is busy', 'email' => 'notmax1000qwe', 'password' => 'max123max', 'surname' => 'Макс', 'name' => 'Макс', 'midlename' => 'Макс',
                'sex' => 'м', 'birthday' => '23-10-2004', 'adress' => 'йцуйцуйцуйцу'],
                '<p style="color: red">Поле username должно быть уникально!</p>'
            ],
        ];
    }

    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = 'D:/xampp/htdocs';
        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Application(new Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/PHP_PRACTICE/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/PHP_PRACTICE/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/PHP_PRACTICE/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }

    }


}
