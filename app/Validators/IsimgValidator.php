<?php

namespace Validators;

use Src\Validators\AbstractValidator;

class IsimgValidator extends AbstractValidator
{
    protected string $message = 'Размер картинки не может превышать 2мб!';

    public function rule(): bool
    {
        if($this->value['type']){
            return in_array($this->value['type'], ['image/png','image/jpeg']);
        }
        return true;
    }
}