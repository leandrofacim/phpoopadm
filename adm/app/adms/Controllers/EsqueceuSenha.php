<?php

declare(strict_types=1);

namespace App\adms\Controllers;

/**
 * Class responsavel por recuperar senha usuario
 */
class EsqueceuSenha
{
    private $dados;

    public function esqueceuSenha()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dados['recuperaSenha'])) {
            $esqueceuSenha = new \App\adms\Models\AdmsEsqueceuSenha();
            $esqueceuSenha->esqueceuSenha($this->dados);
            if ($esqueceuSenha->getResultado()) {
                $urlDestino = URLADM . 'login/acesso';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;
                $carregarView = new \Core\ConfigView('adms/Views/login/esqueceuSenha', $this->dados);
                $carregarView->renderizarLogin();
            }
        } else {
            $carregarView = new \Core\ConfigView('adms/Views/login/esqueceuSenha', $this->dados);
            $carregarView->renderizarLogin();
        }
    }
}
