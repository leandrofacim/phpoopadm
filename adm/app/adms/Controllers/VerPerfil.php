<?php

declare(strict_types=1);

namespace App\adms\Controllers;

class VerPerfil
{
    private $dados;

    public function perfil()
    {
        $verPerfil = new \App\adms\Models\AdmsVerPerfil();
        $this->dados['dados_perfil'] = $verPerfil->verPerfil();

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adms/Views/usuario/perfil", $this->dados);
        $carregarView->renderizar();
    }
}