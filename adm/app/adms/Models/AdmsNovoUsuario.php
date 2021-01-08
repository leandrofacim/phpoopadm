<?php

declare(strict_types=1);

namespace App\adms\Models;

/**
 * Classe Responsavel por cadastrar usuário
 * 
 * @copyright (c) year , Leandro Facim - LF
 * 
 */
class AdmsNovoUsuario
{
    /** @var array $dados contém os dados do usuário */
    private array $dados;

    private bool $resultado;

    private array $infoCadUser;

    private array $dadosEmail;

    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo valida os dados para inserir usuário 
     * no banco de dados
     * 
     * @return void
     */
    public function cadUser(array $dados): void
    {
        $this->dados = $dados;
        $this->validarDados();
        if ($this->resultado) {
            $valEmail = new \App\adms\Models\helper\AdmsEmail();
            $valEmail->valEmail($this->dados['email']);

            $valEmailUnico = new \App\adms\Models\helper\AdmsEmailUnico();
            $valEmailUnico->valEmailUnico($this->dados['email']);

            $valUsuario = new \App\adms\Models\helper\AdmsValUsuario();
            $valUsuario->valUsuario($this->dados['usuario']);

            $valSenha = new \App\adms\Models\helper\AdmsValSenha();
            $valSenha->valSenha($this->dados['senha']);

            if (($valSenha->getResultado()) &&
                ($valUsuario->getResultado()) &&
                ($valEmailUnico->getResultado()) &&
                $valEmail->getResultado()
            ) {
                $this->inserir();
            } else {
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
     * Metodo para inserir Usuário de acesso login
     * 
     * @return void
     */
    private function inserir(): void
    {
        $this->infoCadUser();
        $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['conf_email'] = md5($this->dados['senha'] . date('Y-m-d H:i'));
        $this->dados['adms_niveis_acesso_id'] = $this->infoCadUser[0]['adms_niveis_acesso_id'];
        $this->dados['adms_sits_usuario_id'] = $this->infoCadUser[0]['adms_sits_usuario_id'];
        $this->dados['created'] = date('Y-m-d H:i:s');

        $user = new \App\adms\Models\helper\AdmsCreate();
        $user->create('adms_usuarios', $this->dados);

        if ($user->getResultado()) {
            if ($this->infoCadUser[0]['env_email_conf'] == 1) {
                $this->dadosEmail();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-success'>  
                Usuário cadastrado com sucesso!</div>";
                $this->resultado = true;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            Erro: não foi possivel cadastrar o usuário {$this->dados['usuario']}!</div>";
            $this->resultado = false;
        }
    }

    /** 
     * Metodo para buscar dados para inserir usuário de forma dinamica 
     * 
     * @return void
     */
    private function infoCadUser(): void
    {
        $infoCadUser = new \App\adms\Models\helper\AdmsRead();
        $infoCadUser->fullRead(
            "SELECT 
                env_email_conf, 
                adms_niveis_acesso_id, 
                adms_sits_usuario_id 
                FROM adms_cads_usuarios
            WHERE id =:id LIMIT :limit",
            "id=1&limit=1"
        );
        $this->infoCadUser = $infoCadUser->getResultado();
    }

    private function dadosEmail()
    {
        $nome = explode(" ", $this->dados['nome']);
        $primeiroNome = $nome[0];
        $this->dadosEmail['dest_nome'] = $primeiroNome;
        $this->dadosEmail['dest_email'] = $this->dados['email'];
        $this->dadosEmail['titulo_email'] =  "Confirmar e-mail";
        $this->dadosEmail['cont_email'] = "Caro(a) $primeiroNome , <br><br>";
        $this->dadosEmail['cont_email'] .= "Obrigado por se cadastrar conosco. Para ativar seu perfil, clique no link abaixo:<br><br>";
        $this->dadosEmail['cont_email'] .= "<a href='" . URLADM . "confirmar/confirmar_email?chave=" . $this->dados['conf_email'] . "'>Clique aqui</a><br><br>";
        $this->dadosEmail['cont_email'] .=  "Obrigado<br>";

        $this->dadosEmail['cont_text_email'] = "Caro(a) $primeiroNome, ";
        $this->dadosEmail['cont_text_email'] .= "Obrigado por se cadastrar conosco. Para ativar seu perfil, copie o endereço abaixo e cole no navegador:";
        $this->dadosEmail['cont_text_email'] .= URLADM . "confirmar/confirmar_email?chave=" . $this->dados['conf_email'];
        $this->dadosEmail['cont_text_email'] .=  "Obrigado<br>";

        $mailer = new \App\adms\Models\helper\AdmsPhpMailer();
        $mailer->emailPhpMailer($this->dadosEmail);

        if ($mailer->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>  
            Usuário cadastrado com sucesso. Enviado no seu e-mail o link para confirmar o e-mail!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-info'>
            Usuário cadastrado com sucesso. Erro: não foi possivel enviar o link no seu e-mail para confirmar o e-mail!</div>";
            $this->resultado = false;
        }
    }
}
