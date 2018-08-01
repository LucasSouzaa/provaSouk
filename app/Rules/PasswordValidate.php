<?php

namespace App\Rules;
use App\Usuario;
use Illuminate\Contracts\Validation\Rule;

class PasswordValidate implements Rule
{
    private $pass1, $pass2;

    public function __construct($pass1, $pass2)
    {
        $this->pass1 = $pass1;
        $this->pass2 = $pass2;
    }

    public function passes($attribute, $value)
    {
        return $this->pass1 === $this->pass2;
    }

    public function message()
    {
        return 'Por favor confirme sua senha!';
    }
}