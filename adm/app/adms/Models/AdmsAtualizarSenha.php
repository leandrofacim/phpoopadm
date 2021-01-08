<?php

declare(strict_types=1);

namespace App\adms\Models;

class AdmsAtualizarSenha
{
    /** @var string $chave chave para recuperar senha */
    private $chave;

    /** @var array $dadosUsuario retorno da query */
    private $dadosUsuario;

    private $resultado;

    /** @var array $dados  */
    private $dados;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function validarChave(string $chave): void
    {
        $this->chave = $chave;

        $validaChave = new \App\adms\Models\helper\AdmsRead();
        $validaChave->fullRead(
            "SELECT 
                id,
                recuperar_senha 
                FROM adms_usuarios 
            WHERE recuperar_senha =:recuperar_senha LIMIT :limit",
            "recuperar_senha={$this->chave}&limit=1"
        );
        $this->dadosUsuario = $validaChave->getResultado();

        if (!empty($this->dadosUsuario)) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: Erro link inválido!</div>";
            $this->resultado = false;
        }
    }

    public function atualizaSenha(array $dados)
    {
        $this->dados = $dados;
        $valDados = new \App\adms\Models\helper\ValidaDados();
        $valDados->validarDados($this->dados);
        if ($valDados->getResultado()) {
            $valSenha = new \App\adms\Models\helper\AdmsValSenha();
            $valSenha->valSenha($this->dados['senha']);
            if ($valSenha->getResultado()) {
                $this->updateAtualSenha();
            } else {
                $this->resultado = false;
            }
        }
    }

    private function updateAtualSenha()
    {
        if ($this->resultado) {
            $this->validarChave($this->dados['recuperar_senha']);
            $this->dados['recuperar_senha'] = null;
            $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
            $this->dados['modified'] = date('Y-m-d H:i:s');
            $upAtualSenha = new \App\adms\Models\helper\AdmsUpdate();
            $upAtualSenha->exeUpdate(
                "adms_usuarios",
                $this->dados,
                "WHERE id=:id",
                "id={$this->dadosUsuario[0]['id']}"
            );
            if ($upAtualSenha->getResultado()) {
                $_SESSION['msg'] = "<div class='aler alert-success'>Senha atualizada com sucesso!</div>";
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: A senha não foi atualizada!</div>";
                $this->resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: A senha não foi atualizada!</div>";
            $this->resultado = false;
        }
    }
}
