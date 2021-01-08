<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

class AdmsEmailUnico
{
    private string $email;
    private $resultado;
    private $editarUnico;
    private $dadosId;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function valEmailUnico(string $email, $editarUnico = null, $dadosId = null): void
    {
        $this->email = $email;
        $this->editarUnico = $editarUnico;
        $this->dadosId = $dadosId;
        $valEmailUnico = new \App\adms\Models\helper\AdmsRead();
        if (!empty($this->editarUnico) && ($this->editarUnico === true)) {
             $valEmailUnico->fullRead(
                "SELECT id FROM adms_usuarios WHERE email =:email 
                    AND id <>:id LIMIT :limit", 
                    "email={$this->email}&limit=1&id={$this->dadosId}"
            );
        } else {
            $valEmailUnico->fullRead(
                "SELECT id FROM adms_usuarios 
                WHERE email =:email LIMIT :limit",
                "email={$this->email}&limit=1"
            );
        }
        $this->resultado = $valEmailUnico->getResultado();
        if (!empty($this->resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Este E-mail já está cadastrado!</div>";
            $this->resultado = false;
        } else {
            $this->resultado = true;
        }
    }

    public function validaEmailRecuperarSenha(string $email): void
    {
        $this->email = $email;

        $valEmailUnico = new \App\adms\Models\helper\AdmsRead();
        $valEmailUnico->fullRead(
            "SELECT id FROM adms_usuarios 
            WHERE email =:email LIMIT :limit",
            "email={$this->email}&limit=1"
        );
        $this->resultado = $valEmailUnico->getResultado();
        if (!empty($this->resultado)) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Este E-mail já está cadastrado!</div>";
            $this->resultado = false;
        }
    }
}
