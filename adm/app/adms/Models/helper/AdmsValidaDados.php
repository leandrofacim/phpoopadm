<?php

declare (strict_types=1);

namespace App\adms\Models\helper;

/**
 * Trait para validar dados do formulario
 */
class AdmsValidaDados
{
    private $resultado;
    private $dados;
 
    function getResultado() 
    {
        return $this->resultado;
    }
        
    /**
     * Metodo para tratar dos dados do formulário
     * 
     * @return void
     */
    public function validarDados(array $dados): void
    {
        $this->dados = $dados;
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
}
