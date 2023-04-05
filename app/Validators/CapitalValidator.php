<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class CapitalValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно начинаться с заглавной буквы!';

    public function rule(): bool
    {
        return mb_strtolower(mb_substr($this->value, 0, 1)) != mb_substr($this->value, 0, 1);
    }
}