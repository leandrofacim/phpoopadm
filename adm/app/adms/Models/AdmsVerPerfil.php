<?php

declare(strict_types=1);

namespace App\adms\Models;

class AdmsVerPerfil
{
    private $resultado;

    public function verPerfil()
    {
        $verPerfil = new \App\adms\Models\helper\AdmsRead();
        $verPerfil->fullRead(
            "SELECT * FROM adms_usuarios WHERE id =:id LIMIT :limit",
            "id=" . $_SESSION['usuario_id'] . "&limit=1"
        );
        $this->resultado = $verPerfil->getResultado();

        return $this->resultado;
    }
}
