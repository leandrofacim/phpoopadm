<?php

declare(strict_types=1);

namespace App\adms\Controllers;

/**
 * Class Responsavel por alterar senha do usuario
 *
 * @author Leandro Facim
 */
class EditarPerfil
{

    /** @var array */
    private $dados;

    public function alterarPerfil()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dados['ediPerfil'])) {
            unset($this->dados['ediPerfil']);
            $this->dados['imagem'] = $_FILES['imagem'] ? $_FILES['imagem'] : null;
            $objAltPerfil = new \App\adms\Models\AdmsEditarPerfil();
            $objAltPerfil->alterarPerfil($this->dados);
            if ($objAltPerfil->getResultado()) {
                $urlDestino = URLADM . 'ver-perfil/perfil';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;
                $this->alterarPerfilPriv();
            }
        } else {
            $verPerfil = new \App\adms\Models\AdmsVerPerfil();
            $this->dados['form'] = $verPerfil->verPerfil();
            $this->alterarPerfilPriv();
        }
    }

    private function alterarPerfilPriv()
    {
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/usuario/editPerfil", $this->dados);
        $carregarView->renderizar();
    }

}
