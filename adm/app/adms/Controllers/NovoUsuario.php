<?php

namespace App\adms\Controllers;

/**
 * Description of NovoUsuario
 * 
 * @copyright (c) year, Leandro facim - LF
 */
class NovoUsuario
{
    private $dados;

    public function novoUsuario()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dados['cadUserLogin'])) {
            unset($this->dados['cadUserLogin']);
            $user = new \App\adms\Models\AdmsNovoUsuario();
            $user->cadUser($this->dados);
            if ($user->getResultado()) {
                $urlDestino = URLADM . 'login/acesso';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;
                $carregarView = new \Core\ConfigView("adms/Views/login/novoUsuario", $this->dados);
                $carregarView->renderizarLogin();
            }
        } else {
            $carregarView = new \Core\ConfigView("adms/Views/login/novoUsuario", $this->dados);
            $carregarView->renderizarLogin();
        }
    }
}
