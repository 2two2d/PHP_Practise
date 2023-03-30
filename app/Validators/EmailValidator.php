<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class EmailValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать символ "@"!';

    public function rule(): bool
    {
        return str_contains($this->value, '@');
    }
}