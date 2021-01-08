<?php

declare(strict_types=1);

namespace app\adms\Models;

class AdmsMenu
{
    private $resultado;
    
    public function getResultado()
    {
        return $this->resultado;
    }

    public function itemMenu(): array
    {
        $listItemMenu = new \App\adms\Models\helper\AdmsRead();
        $listItemMenu->fullRead(
            "SELECT 
            nivpg.dropdown,
            men.id id_men,
            men.nome nome_men,
            men.icone icone_men,
            pg.id id_pg,
            pg.menu_controller,
            pg.menu_metodo,
            pg.nome_pagina,
            pg.icone icone_pg
                FROM adms_nivacs_pgs nivpg
            INNER JOIN adms_menus men ON men.id=nivpg.adms_menu_id
            INNER JOIN adms_paginas pg ON pg.id=nivpg.adms_pagina_id
            WHERE nivpg.adms_niveis_acesso_id =:adms_niveis_acesso_id
            AND nivpg.permissao=:permissao
            AND nivpg.lib_menu=:lib_menu
            ORDER BY men.ordem, nivpg.ordem ASC",
            "adms_niveis_acesso_id=" . $_SESSION['adms_niveis_acesso_id'] . "&permissao=1&lib_menu=1"
        );
        $this->resultado = $listItemMenu->getResultado();
       
        return $this->resultado;
    }
}
