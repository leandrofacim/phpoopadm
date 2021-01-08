<?php

declare(strict_types=1);

namespace App\adms\Controllers;

class AtualizarSenha
{
    private $chave;
    private $dados;

    public function atualizarSenha()
    {
        $this->chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->chave)) {
            $validaChave = new \App\adms\Models\AdmsAtualizarSenha();
            $validaChave->validarChave($this->chave);
            if ($validaChave->getResultado()) {
                $this->atualSenha();
            } else {
                $urlDestino = URLADM . 'login/acesso';
                header('Location:' . $urlDestino);
            }
        } else {
            $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: Erro link inválido!</div>";
            $urlDestino = URLADM . 'login/acesso';
            header('Location:' . $urlDestino);
        }
    }

    private function atualSenha()
    {
        if (!empty($this->dados['atualizarSenha'])) {
            unset($this->dados['atualizarSenha']);
            $this->dados['recuperar_senha'] = $this->chave;
            $atualizarSenha = new \App\adms\Models\AdmsAtualizarSenha();
            $atualizarSenha->atualizaSenha($this->dados);
            if ($atualizarSenha->getResultado()) {
                $urlDestino = URLADM . 'login/acesso';
                header('Location:' . $urlDestino);
            } else {
                $carregarView = new \Core\ConfigView('adms/Views/login/atualizarSenha', $this->dados);
                $carregarView->renderizarLogin();
            }
        } else {
            $carregarView = new \Core\ConfigView('adms/Views/login/atualizarSenha', $this->dados);
            $carregarView->renderizarLogin();
        }
    }
}
