<?php

declare(strict_types=1);

namespace App\adms\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class AdmsPaginas
{
    private array $resultado;
    private string $urlController;
    private string $urlMetodo;

    /**
     * Respónsavel por buscar a controlle e o metodo no banco de dados 
     * 
     * @param string $urlController classe controller
     * @param string $urlMetodo metodo da classe
     * 
     * @return array
     */
    public function listarPaginas($urlController = null, $urlMetodo = null): array
    {
        $this->urlController = (string) $urlController;
        $this->urlMetodo = (string) $urlMetodo;

        $listar = new \App\adms\Models\helper\AdmsRead();
        $_SESSION['adms_niveis_acesso_id'] = $_SESSION['adms_niveis_acesso_id'] ?? null;

        $listar->fullRead(
            "SELECT pg.id,
                tpg.tipo tipo_tpg
                FROM adms_paginas pg
                INNER JOIN adms_tps_pgs tpg ON tpg.id=pg.adms_tps_pg_id
                LEFT JOIN adms_nivacs_pgs nivpg ON nivpg.adms_pagina_id=pg.id AND nivpg.adms_niveis_acesso_id =:adms_niveis_acesso_id
                WHERE (pg.controller =:controller
                AND pg.metodo =:metodo) AND ((pg.lib_pub =:lib_pub) OR (nivpg.permissao =:permissao))
                LIMIT :limit",
            "adms_niveis_acesso_id={$_SESSION['adms_niveis_acesso_id']}&controller={$this->urlController}&metodo={$this->urlMetodo}&lib_pub=1&permissao=1&limit=1"
        );

        $this->resultado = $listar->getResultado();
        return $this->resultado;
    }
}
