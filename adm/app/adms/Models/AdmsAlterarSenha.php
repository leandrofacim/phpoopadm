<?php

declare(strict_types=1);

namespace App\adms\Models;

/**
 * Class Responsavel por alterar senha do usuário
 *
 * @author Leandro Facim
 */
class AdmsAlterarSenha 
{   
    private $resultado;
    private $dados;
    
    function getResultado() 
    {
        return $this->resultado;
    }
    
    public function alterarSenha(array $dados) 
    {
        $this->dados = $dados;;
        $valSenha = new \App\adms\Models\helper\AdmsValSenha();
        $valSenha->valSenha($this->dados['senha']);
        if ($valSenha->getResultado()) {
            $this->updateAltSenha();
        } else {
            $this->resultado = false;
        }
    }
    
    private function updateAltSenha() 
    {
        $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['modified'] = date('Y-m-d H:i:s');
        $updateSenha = new \App\adms\Models\helper\AdmsUpdate();
        $updateSenha->exeUpdate(
                "adms_usuarios", 
                $this->dados, 
                "WHERE id=:id", 
                "id=". $_SESSION['usuario_id']
            );
        if ($updateSenha->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Senha alterada com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Ops algo deu errado!</div>";
            $this->resultado = false;
        }
    }
}
