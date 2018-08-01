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
        $cpf = $value;

        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
        // Valida tamanho
        if (strlen($cpf) != 11)
            return false;
        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);

    }

    public function message()
    {
        return 'CPF Inválido!';
    }
}