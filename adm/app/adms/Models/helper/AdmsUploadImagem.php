<?php

declare (strict_types=1);

namespace App\adms\Models\helper;

/**
 * Classe para upload de imagem
 *
 * @copyright (c) year, Leandro Facim 
 */
class AdmsUploadImagem
{

    /** @var string */
    protected $dadosImagem;

    /** @var string */
    protected $diretorio;

    /** @var string */
    protected $nomeImagem;

    /** @var bool */
    protected $resultado;
    
    protected $imagem;

    function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo responsavel por realizar upload de foto
     * 
     * @param array $imagem dados da imagem
     * @param string $diretorio onde a imagem vai ser salva
     * @param string $nomeImagem 
     * 
     * @return void 
     * */
    public function uploadImagem(
            array $imagem,
            string $diretorio,
            string $nomeImagem
    )
    {
        $this->dadosImagem = $imagem;
        $this->diretorio = $diretorio;
        $this->nomeImagem = $nomeImagem;
        $this->validarImagem();
    }

    /*
     * Metodo responsavel por validar formato da imagem
     * 
     * @return void
     * */
    public function validarImagem()
    {
        $this->imagem = match ($this->dadosImagem['type']) {
           'image/jpeg', 'image/pjpeg' =>  imagecreatefromjpeg($this->dadosImagem['tmp_name']),
           'image/png', 'image/x-png' => imagecreatefrompng($this->dadosImagem['tmp_name']),
           default => '',
        };
        if($this->imagem){
            $this->validarDiretorio();
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A extensão
                da imagem é inválida. Selecione um imagem JPEG ou PNG!</div>";
            $this->resultado = false;
        }
    }
    
    private function validarDiretorio()
    {
        if (!file_exists($this->diretorio) && !is_dir($this->diretorio)) {
            mkdir($this->diretorio, 0755);
        }
        $this->realizaUpload();
    }
    
    private function realizaUpload()
    {
        if (move_uploaded_file($this->dadosImagem['tmp_name'], $this->diretorio . $this->nomeImagem)) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi
                realizado o upload da imagem!</div>";
            $this->resultado = false;
        }
    }        
        
}
