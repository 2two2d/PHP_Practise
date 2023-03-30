<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class RequireValidator extends AbstractValidator
{

    protected string $message = 'Поле :field обязательно!';

    public function rule(): bool
    {
        return !empty($this->value);
    }
}
