<?php

declare(strict_types=1);

namespace App\adms\Models;

/**
 * Classe Responsavel por editar perfil
 *
 * @author Leandro Facim
 */
class AdmsEditarPerfil
{

    /** @var array */
    private $dados;

    /** @var bool */
    private $resultado;

    /** @var array */
    private $foto;

    /** @var int */
    private $altura = 150;

    /** @var int */
    private $largura = 150;

    /** @var string */
    private $ImagemAntiga;

    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo altera dados do perfil usuário
     * 
     * @param array $dados
     * 
     * @return void
     */
    public function alterarPerfil(array $dados): void
    {
        $this->dados = $dados;
        $this->foto = $this->dados['imagem'];
        $this->ImagemAntiga = $this->dados['imagemAntiga'];
        unset($this->dados['imagem'], $this->dados['imagemAntiga']);
        
        $valDados = new \App\adms\Models\helper\AdmsValidaDados();
        $valDados->validarDados($this->dados);
        
        if ($valDados->getResultado()) {
            $this->validarCampos();
        } else {
            $this->resultado = false;
        }
    }

    private function validarCampos()
    {
        $validaEmail = new \App\adms\Models\helper\AdmsEmail();
        $validaEmail->valEmail($this->dados['email']);

        $validaEmailUnico = new \App\adms\Models\helper\AdmsEmailUnico();
        $editarUnico = true;
        $validaEmailUnico->valEmailUnico(
                $this->dados['email'],
                $editarUnico,
                $_SESSION['usuario_id']
        );
        $validaUsuarioUnico = new \App\adms\Models\helper\AdmsValUsuario();
        $validaUsuarioUnico->valUsuario(
                $this->dados['usuario'],
                $editarUnico,
                $_SESSION['usuario_id']
        );
        if (
                ($validaEmail->getResultado()) &&
                ($validaEmailUnico->getResultado()) &&
                ($validaUsuarioUnico->getResultado())) {
            $this->validaFoto();
        } else {
            $this->resultado = false;
        }
    }

    private function validaFoto()
    {
        if (empty($this->foto['name'])) {
            $this->updatePerfil();
        } else {
            $slugImagem = new \App\adms\Models\helper\AdmsSlug();
            $this->dados['imagem'] = $slugImagem->nomeSulg($this->foto['name']);
            
            $uploadImg = new \App\adms\Models\helper\AdmsUploadImagemRed();
            $diretorioImagem = 'assets/imagens/usuario/' . $_SESSION['usuario_id'] . '/';
            $uploadImg->uploadImagem(
                    $this->foto,
                    $diretorioImagem,
                    $this->dados['imagem'],
                    $this->altura,
                    $this->largura
            );
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImagem();
                $apagarImg->apagarImagem('assets/imagens/usuario/' . $_SESSION['usuario_id'] . '/' . $this->ImagemAntiga);
                $this->updatePerfil();
            } else {
                $this->resultado = false;
            }
        }
    }

    private function updatePerfil()
    {
        $this->dados['modified'] = date('Y-m-d H:i:s');
        $updatePerfil = new \App\adms\Models\helper\AdmsUpdate();
        $updatePerfil->exeUpdate(
                'adms_usuarios',
                $this->dados,
                'WHERE id =:id',
                'id=' . $_SESSION['usuario_id']
        );
        if ($updatePerfil->getResultado()) {
            $_SESSION['usuario_nome'] = $this->dados['nome'];
            $_SESSION['usuario_email'] = $this->dados['email'];
            $_SESSION['usuario_imagem'] = $this->dados['imagem'];
            $_SESSION['msg'] = "<div class='alert alert-success'>
                    Perfil atualizado com seucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
                   Erro: O Perfil não foi atualizado com seucesso!</div>";
            $this->resultado = false;
        }
    }

}
