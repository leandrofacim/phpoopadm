<?php

declare(strict_types=1);

namespace App\adms\Models;

class AdmsEsqueceuSenha
{
    private $resultado;
    private $dadosUsuario;
    private $dados;
    private $dadosEmail;
    private $dadosUpdate;

    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo para recuperar senha do usuario
     * 
     * @param array $email email do usuario
     * 
     * @return void
     */
    public function esqueceuSenha(array $dados): void
    {
        $this->dados = $dados;
        $this->validarDados();
        if ($this->resultado) {
            $esqueceuSenha = new \app\adms\Models\helper\AdmsRead();
            $esqueceuSenha->fullRead(
                'SELECT id, nome, usuario, recuperar_senha FROM adms_usuarios WHERE email =:email LIMIT :limit',
                "email={$this->dados['email']}&limit=1"
            );
            $this->dadosUsuario = $esqueceuSenha->getResultado();

            if (!empty($this->dadosUsuario)) {
                $this->validarChaveRecuperarSenha();
            } else {
                $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: E-mail não cadastrado</div>";
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
            Erro: Necessário preencher o campo E-mail!</div>";
            $this->resultado = false;
        } else {
            $validaEmail = new \App\adms\Models\helper\AdmsEmailUnico();
            $validaEmail->validaEmailRecuperarSenha($this->dados['email']);
            if ($validaEmail->getResultado()) {
                $this->resultado = true;
            } else {
                $this->resultado = false;
            }
        }
    }

    /**
     * Metodo para validar se existe recuperar recuperar
     * 
     * @return void
     */
    private function validarChaveRecuperarSenha(): void
    {
        if (!empty($this->dadosUsuario[0]['recuperar_senha'])) {
            $this->dadosEmail();
        } else {
            $this->dadosUpdate['recuperar_senha'] = md5($this->dadosUsuario[0]['id'] . date('Y-m-d H:i:s'));
            $this->dadosUpdate['modified'] = date('Y-m-d H:i:s');

            $updateRecSenha = new \App\adms\Models\helper\AdmsUpdate();
            $updateRecSenha->exeUpdate(
                'adms_usuarios',
                $this->dadosUpdate,
                "WHERE id =:id",
                "id={$this->dadosUsuario[0]['id']}"
            );
            if ($updateRecSenha->getResultado()) {
                $this->dadosUsuario[0]['recuperar_senha'] = $this->dadosUpdate['recuperar_senha'];
                $this->dadosEmail();
            } else {
                $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: Erro ao recuperar senha</div>";
                $this->resultado = false;
            }
        }
    }

    private function dadosEmail()
    {
        $nome = explode(" ", $this->dadosUsuario[0]['nome']);
        $primeiroNome = $nome[0];
        $this->dadosEmail['dest_nome'] = $primeiroNome;
        $this->dadosEmail['dest_email'] = $this->dados['email'];
        $this->dadosEmail['titulo_email'] = "Recuperar senha";
        $this->dadosEmail['cont_email'] = "Olá " . $primeiroNome . "<br><br>";
        $this->dadosEmail['cont_email'] .= "Você solicitou uma alteração de senha.<br>";
        $this->dadosEmail['cont_email'] .= "Seguindo o link abaixo você poderá alterar sua senha.<br>";
        $this->dadosEmail['cont_email'] .= "Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço abaixo no seu navegador.<br><br>";
        $this->dadosEmail['cont_email'] .= "<a href='" . URLADM . "atual-senha/atual-senha?chave=" . $this->dadosUsuario[0]['recuperar_senha'] . "'>Clique aqui</a><br><br>";
        $this->dadosEmail['cont_email'] .= "Usuário: " . $this->dadosUsuario[0]['usuario'] . "<br><br>";
        $this->dadosEmail['cont_email'] .= "Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";


        $this->dadosEmail['cont_text_email'] = "Olá " . $primeiroNome . " Você solicitou uma alteração de senha. 
        Seguindo o link abaixo você poderá alterar sua senha. Para continuar o processo de recuperação de sua senha,
        clique no link abaixo ou cole o endereço abaixo no seu navegador. " 
        . URLADM . "atualizar-senha/atualizar-senha?chave=" 
        . $this->dadosUsuario[0]['recuperar_senha'] . " Usuário: " . $this->dadosUsuario[0]['usuario'] .
        "Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha 
        permanecerá a mesma até que você ative este código.";

        $emailPhpMailer = new \App\adms\Models\helper\AdmsPhpMailer();
        $emailPhpMailer->emailPhpMailer($this->dadosEmail);
        if ($emailPhpMailer->getResultado()) {
            $_SESSION['msg'] = "<div class='aler alert-success'>E-mail enviado com sucesso, verifique sua caixa de entrada!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='aler alert-danger'>Erro: Erro ao recuperar senha</div>";
            $this->resultado = false;
        }
    }
}
