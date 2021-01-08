<?php

declare(strict_types=1);

namespace App\adms\Models;

/**
 *  Class para confirmação de E-mail
 */
class AdmsConfirmarEmail
{
    /** @var string $dadosChave Recebe a chave para confirmar e-mail */
    private string $dadosChave;

    private $dadosUsuario;

    private $resultado;

    private $dados;

    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo busca email existente no banco de dados
     * e envia a confirmação no email do usuario
     * 
     * @param string $chave chave para coonfirmar email
     * 
     * @return void
     * 
     */
    public function confirmarEmail(string $chave): void
    {
        $this->dadosChave = $chave;

        $validaChave = new \App\adms\Models\helper\AdmsRead();
        $validaChave->fullRead(
            "SELECT id FROM adms_usuarios WHERE conf_email =:conf_email LIMIT :limit",
            "conf_email={$this->dadosChave}&limit=1"
        );
        $this->dadosUsuario = $validaChave->getResultado();

        if (!empty($this->dadosUsuario)) {
            $this->updateConfEmail();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Link de confirmação inválido!</div>";
            $this->resultado = false;
        }
    }

    /**
     * Metodo resposavel por realizar update de cinfirmação de email
     * 
     * @return void
     */
    private function updateConfEmail(): void
    {
        $this->dados['conf_email'] = null;
        $this->dados['adms_sits_usuario_id'] = 1;
        $this->dados['modified'] = date('Y-m-d H:i:s');

        $updateConfEmail = new \App\adms\Models\helper\AdmsUpdate();
        $updateConfEmail->exeUpdate(
            'adms_usuarios',
            $this->dados,
            'WHERE id =:id',
            "id={$this->dadosUsuario[0]['id']}"
        );
        if ($updateConfEmail->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>E-mail confirmado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $this->resultado = false;
        }
    }
}
