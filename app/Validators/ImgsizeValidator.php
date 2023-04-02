<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class ImgsizeValidator extends AbstractValidator
{
    protected string $message = 'Размер картинки не может превышать 2мб!';

    public function rule(): bool
    {
        return $this->value['size'] <= 2048000;
    }
}