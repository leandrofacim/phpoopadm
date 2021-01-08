<?php

declare(strict_types=1);

namespace App\adms\Controllers;

/**
 * Class Responsavel por alterar senha do usuario
 *
 * @author Leandro Facim
 */
class AlterarSenha
{
    /** @var array */
    private $dados;

    public function alterarSenha()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dados['alterarSenha'])) {
            unset($this->dados['alterarSenha']);
            $objAltSenha = new \App\adms\Models\AdmsAlterarSenha();
            $objAltSenha->alterarSenha($this->dados);
            if ($objAltSenha->getResultado()) {
                $urlDestino = URLADM . 'ver-perfil/perfil';
                header("Location: $urlDestino");
            } else {
                $listarMenu = new \App\adms\Models\AdmsMenu();
                $this->dados['menu'] = $listarMenu->itemMenu();

                $carregarView = new \Core\ConfigView("adms/Views/usuario/alterarSenha", $this->dados);
                $carregarView->renderizar();
            }
        } else {
            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adms/Views/usuario/alterarSenha", $this->dados);
            $carregarView->renderizar();
        }
    }
}
