<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class CapitalValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно начинаться с заглавной буквы!';

    public function rule(): bool
    {
        return mb_strtolower((String)$this->value[0]) != (String)$this->value[0];
    }
}