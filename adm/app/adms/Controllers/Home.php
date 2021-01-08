<?php

namespace App\adms\Controllers;

if (!defined('URL')) {;
    header('Location: /');
    exit();
}

class Home
{
    private $dados;

    public function index()
    {     
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \Core\ConfigView('adms/Views/home/home', $this->dados);
        $carregarView->renderizar();
    }
}
