<?php

namespace App\Rules;
use App\Usuario;
use Illuminate\Contracts\Validation\Rule;

class CpfValidate implements Rule
{
    private $ignore;

    public function __construct($ignore = 0)
    {
        $this->ignore = $ignore;
    }

    public function passes($attribute, $value)
    {
        $strCPF = $value;
        $strCPF = preg_replace('/[.,-]/', "", $strCPF);
        $sum = 0;

        for ($i = 1; $i <= 9; $i++) $sum = $sum + ((int)substr($strCPF, $i - 1, $i)) * (11 - $i);
        $remainder = ($sum * 10) % 11;

        if (($remainder == 10) || ($remainder == 11)) $remainder = 0;
        if ($remainder != ((int)substr($strCPF, 9, 10))) return false;

        $sum = 0;
        for ($i = 1; $i <= 10; $i++) $sum = $sum + ((int)substr($strCPF, $i - 1, $i)) * (12 - $i);
        $remainder = ($sum * 10) % 11;

        if (($remainder == 10) || ($remainder == 11)) $remainder = 0;
        if ($remainder != ((int)substr($strCPF, 10, 11))) return false;
        return true;

    }

    public function message()
    {
        return 'CPF Inválido!';
    }
}