<?php

declare(strict_types=1);

namespace App\adms\Controllers;

/** Class de confirmação de E-mail */
class Confirmar
{
    private string $dadosChave;

    public function confirmarEmail()
    {
        $this->dadosChave = filter_input(INPUT_GET, 'chave', FILTER_SANITIZE_STRING);
        if (!empty($this->dadosChave)) {
            $confEmail = new \App\adms\Models\AdmsConfirmarEmail();
            $confEmail->confirmarEmail($this->dadosChave);
            if (!empty($confEmail->getResultado())) {
                $urlDestino = URLADM . 'login/acesso';
                header("Location: $urlDestino");
            } else {
                $urlDestino = URLADM . 'login/acesso';
                header("Location: $urlDestino");
            }
            
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Link de confirmação inválido!</div>";
            $urlDestino = URLADM . 'login/acesso';
            header("Location: $urlDestino");
        }
    }
}