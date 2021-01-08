<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

class AdmsValUsuario
{
    private string $usuario;
    private $resultado;
    private $editarUnico;
    private $dadosId;
    
    public function getResultado()
    {
        return $this->resultado;
    }

    public function valUsuario(string $usuario, $editarUnico = null, $dadosId = null): void
    {
        $this->usuario = $usuario;
        $this->editarUnico = $editarUnico;
        $this->dadosId = $dadosId;
        
        $valUsuario = new \App\adms\Models\helper\AdmsRead();
        if (!empty($this->editarUnico) && ($this->editarUnico === true)) {
            $valUsuario->fullRead(
                "SELECT id FROM adms_usuarios 
                WHERE usuario =:usuario AND id <>:id LIMIT :limit",
                "usuario={$this->usuario}&id={$this->dadosId}&limit=1"
            );  
        } else {
            $valUsuario->fullRead(
                "SELECT id FROM adms_usuarios 
                WHERE usuario =:usuario LIMIT :limit",
                "usuario={$this->usuario}&limit=1"
            );
        }
        
        $this->resultado = $valUsuario->getResultado();
        if (!empty($this->resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Este Usuário já está cadastrado!</div>";
            $this->resultado = false;
        } else {
            $this->validaCaracterUsuario();
        }
    }

    private function validaMinValorUsuario()
    {
        if (strlen($this->usuario) < 5) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: O usuário deve ter no mínimo 5 caracteres!</div>";
            $this->resultado = false;
        } else {
            $this->resultado = true;
        }
    }

    private function validaCaracterUsuario()
    {
        if (stristr($this->usuario, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Caracter (') utilizado no usuário inválido!</div>";
            $this->resultado = false;
        } else {
            if (stristr($this->usuario, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                Erro: Proibido utilizar espaço em branco no usuário!</div>";
                $this->resultado = false;
            } else {
                $this->validaMinValorUsuario();
            }
        }
    }
}
