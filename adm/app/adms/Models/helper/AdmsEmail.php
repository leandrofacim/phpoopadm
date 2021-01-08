<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

/** Classe para validação de email */
class AdmsEmail
{
    private bool $resultado;
    private string $dados;
    private string $formato;

    public function getResultado(): bool
    {
        return $this->resultado;
    }

    /**
     * Responsável por validar email
     * 
     * @param string $email email do usuario
     * 
     * @return void
     */
    public function valEmail(string $email): void
    {
        $this->dados = $email;
        $this->formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match($this->formato, $this->dados)) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: E-mail inválido!</div>";
            $this->resultado = false;
        }
    }
}
