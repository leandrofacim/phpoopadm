<?php

declare(strict_types=1);

namespace Core;

/**
 * Description of ConfigView
 *
 * copyrigt (c) year, Leandro Facim
 */
class ConfigView
{
    private string $nome;
    private  $dados;

    public function __construct(string $nome, $dados)
    {
        $this->nome = $nome;
        $this->dados = $dados;
    }

    /**
     * Responsável por renderizar as views
     * 
     * @return void
     */
    public function renderizar(): void
    {
        include 'app/adms/Views/includes/cabecalhoAdm.php';
        include 'app/adms/Views/includes/header.php';
        include 'app/adms/Views/includes/sidebar.php';
        
        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/' . $this->nome . '.php';
        } else {
            echo "Erro ao carregar a Página: {$this->nome}";
        }
        include 'app/adms/Views/includes/rodapeAdm.php';
    }

    public function renderizarLogin()
    {
        include 'app/adms/Views/includes/cabecalho.php';

        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/' . $this->nome . '.php';
        } else {
            echo "Erro ao carregar a Página: {$this->nome}";
        }
    }
}
