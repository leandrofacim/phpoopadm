<?php

declare(strict_types=1);

namespace App\adms\Models;

/**
 * Classe Responsavel por realizar login
 * 
 * @copyright (c) year , Leandro Facim - LF
 * 
 */
class AdmsLogin
{
    /** @var array $dados contém os dados do usuário */
    private array $dados;

    private $resultado;

    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo de acesso
     * 
     * @param array $dados Amarzena os valores do formulario de login
     * 
     * @return void 
     */
    public function acesso(array $dados): void
    {
        $this->dados = $dados;
        $this->validarDados();

        if ($this->resultado) {
            $validaLogin = new \App\adms\Models\helper\AdmsRead();
            $validaLogin->fullRead(
                'SELECT
                user.id,
                user.nome,
                user.email,
                user.senha,
                user.imagem,
                user.adms_niveis_acesso_id,
                nivac.ordem ordem_nivac
            FROM
                adms_usuarios user
            INNER JOIN adms_niveis_acessos nivac 
            ON nivac.id = user.adms_niveis_acesso_id
            WHERE
                usuario =:usuario
            LIMIT :limit',
                "usuario={$this->dados['usuario']}&limit=1"
            );
            $this->resultado = $validaLogin->getResultado();

            if ($this->resultado) {
                $this->validarSenha();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                Erro: Usuário não encontrado!</div>";
                $this->resultado = false;
            }
        }
    }

    /**
     * Metodo para tratar dos dados do formulário
     * 
     * @return void
     */
    private function validarDados(): void
    {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);

        if (in_array('', $this->dados)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Necessário preencher todos os campos!</div>";
            $this->resultado = false;
        } else {
            $this->resultado = true;
        }
    }

    /**
     * Metodo Responsavel por validar senha e salvar dados na sessao
     * 
     * @return void
     */
    private function validarSenha(): void
    {
        if (password_verify($this->dados['senha'], $this->resultado[0]['senha'])) {
            $_SESSION['usuario_id'] = $this->resultado[0]['id'];
            $_SESSION['usuario_nome'] = $this->resultado[0]['nome'];
            $_SESSION['usuario_email'] = $this->resultado[0]['email'];
            $_SESSION['usuario_imagem'] = $this->resultado[0]['imagem'];
            $_SESSION['adms_niveis_acesso_id'] = $this->resultado[0]['adms_niveis_acesso_id'];
            $_SESSION['ordem_nivac'] = $this->resultado[0]['ordem_nivac'];
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: Usuário ou senha incorreto!</div>";
            $this->resultado = false;
        }
    }
}
