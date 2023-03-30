<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class PasswordValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать минимум 8 символов!';

    public function rule(): bool
    {
        return strlen((String)$this->value) >= 8;
    }
}