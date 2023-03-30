<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class SpaceValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не должно содержать пробелы!';

    public function rule(): bool
    {
        return !str_contains($this->value, ' ');
    }
}