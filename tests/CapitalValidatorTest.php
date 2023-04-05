<?php
use PHPUnit\Framework\TestCase;
use Src\Application;
use Src\Settings;
use Src\Validators\Validator;
use Validators\CapitalValidator;

class CapitalValidatorTest extends TestCase
{
    /**
     * @dataProvider additionProviderPersonalData
     */

    public function testValidator(array $request): void
    {
        $rule = ['name' => ['startswithcapital']];
        $message = ['startswithcapital' => 'Поле :field должно начинаться с заглавной буквы!'];
        $validator = new Validator($request, $rule, $message);
        $errors = $validator->errors();
        if(mb_strtolower(mb_substr($request['name'], 0, 1)) != mb_substr($request['name'], 0, 1)){
            $this->assertTrue(empty($errors));
        }else{
            $this->assertTrue(str_contains($errors['name'][0], 'Поле name должно начинаться с заглавной буквы!'));
        }
    }



    public static function additionProviderPersonalData(): array
    {
        return [
            [['name' => 'Максим']],
            [['name' =>'максим']],
            [['name' =>'1максим']],
            [['name' =>'1Максим']]
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