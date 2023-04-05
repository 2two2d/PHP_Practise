<?php
use PHPUnit\Framework\TestCase;
use Controller\AuthSite;
use Src\Application;
use Src\Request;
use Model\User;
use Src\Settings;


class LoginTest extends TestCase
{
    /**
     * @dataProvider additionProviderLogin
     */

    public function testLogin(string $httpMethod, array $userData, string $message): void
    {
        $auth = new AuthSite();
        $auth->logout();
        //Выбираем занятый логин из базы данных

        // Создаем заглушку для класса Request.
        $request = $this->createMock(Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = $auth->login($request);

        if (!$userData['username'] && !$userData['password']) {
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        $this->assertTrue((bool)app()->auth->user()->username);
        $this->assertContains($message, xdebug_get_headers());
        $auth->logout();
    }



    public static function additionProviderLogin(): array
    {
        return [
            ['POST', ['username' => '2two2d', 'password' => 'max123max'],
                'Location: /PHP_PRACTICE/personal_data'
            ],
            ['POST', ['username' => '', 'password' => ''],
                '<h3>Неправильные логин или пароль</h3>'
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
