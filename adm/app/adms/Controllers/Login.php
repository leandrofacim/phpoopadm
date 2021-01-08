<?php

namespace App\adms\Controllers;

/**
 * Class de Login de usuário
 * 
 * @copyright (c) year, Leandro facim - LF
 */
class Login
{
    private $dados;

    public function acesso()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (!empty($this->dados['sendLogin'])) {
            unset($this->dados['sendLogin']);
            $visualLogin = new \App\adms\Models\AdmsLogin();
            $visualLogin->acesso($this->dados);
            if ($visualLogin->getResultado()) {
                $urlDestino = URLADM . 'home/index';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;
            }
        }

        $carregarView = new \Core\ConfigView('adms/Views/login/acesso', $this->dados);
        $carregarView->renderizarLogin();
    }

    public function logout()
    {
        unset($_SESSION['usuario_id'], $_SESSION['usuario_nome'],
        $_SESSION['usuario_email'], $_SESSION['usuario_imagem'],
        $_SESSION['adms_niveis_acesso_id'], $_SESSION['ordem_nivac']);
        $_SESSION['msg'] = "<div class='alert alert-success'>Deslogado com sucesso</div>";
        $urlDestino = URLADM . 'login/acesso';
        header("Location: $urlDestino");
    }
}
