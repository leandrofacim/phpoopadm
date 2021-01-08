<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

class AdmsValSenha
{
    private string $senha;
    private $resultado;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function valSenha(string $senha): void
    {
        $this->senha = $senha;

        if (stristr($this->senha, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Caracter (') utilizado no senha inválido!</div>";
            $this->resultado = false;
        } else {
            if (stristr($this->senha, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                Erro: Proibido utilizar espaço em branco no campo senha!</div>";
                $this->resultado = false;
            } else {
                $this->validaMinValorSenha();
            }
        }
    }

    private function validaMinValorSenha()
    {
        if (strlen($this->senha) < 6) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: A senha deve ter no mínimo 6 caracteres!</div>";
            $this->resultado = false;
        } else {
            $this->resultado = true;
        }
    }
}
