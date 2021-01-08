<?php

declare (strict_types=1);

namespace App\adms\Models\helper;

/**
 * Classe responsavel por deletar imagem antiga
 *
 * @copyright (c) year, Leandro Facim 
 */
class AdmsApagarImagem
{
    private $nomeImagem;
    private $diretorio;
    
    public function apagarImagem(string $nomeImagem, string $diretorio = null)
    {
        $this->nomeImagem = $nomeImagem;
        $this->diretorio = $diretorio;
        $this->excluirImagem();
        if (!empty($this->diretorio)) {
            $this->excluirDiretorio();
        }
    }
    
    private function excluirImagem()
    {
        if (file_exists($this->nomeImagem)) {
            unlink($this->nomeImagem);
        }
    }
    
    private function excluirDiretorio()
    {
        if (file_exists($this->diretorio)) {
            rmdir($this->diretorio);
        }
    }
}
