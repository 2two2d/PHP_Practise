<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class OnlycharsValidator extends AbstractValidator
{
    protected string $message = 'Поле :field может содержать только кириллицу';

    public function rule(): bool
    {
        return preg_match('/^[а-яё]++$/ui',$this->value);
    }
}