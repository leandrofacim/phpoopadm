<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

/**
 * Classe para upload de imagem redimencionda
 *
 * @copyright (c) year, Leandro Facim 
 */
class AdmsUploadImagemRed
{

    private $dadosImagem;
    private $diretorio;
    private $nomeImagem;
    private $imagem;
    private $resultado;
    private $largura;
    private $altura;
    private $imgRedimencionada;

    function getResultado()
    {
        return $this->resultado;
    }

    public function uploadImagem(
            array $imagem,
            $diretorio,
            $nomeImagem,
            $largura,
            $altura
    )
    {
        $this->dadosImagem = $imagem;
        $this->diretorio = $diretorio;
        $this->nomeImagem = $nomeImagem;
        $this->altura = $altura;
        $this->largura = $largura;
        $this->validarImagem();
        if ($this->imagem) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A extensão
                da imagem é inválida. Selecione um imagem JPEG ou PNG!</div>";
            $this->resultado = false;
        }
    }

    private function validarImagem()
    {
        switch ($this->dadosImagem['type']) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->imagem = imagecreatefromjpeg($this->dadosImagem['tmp_name']);
                $this->redimencionarImagem();
                $this->validarDiretorio();
                imagejpeg($this->imgRedimencionada, $this->diretorio . $this->nomeImagem);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->imagem = imagecreatefrompng($this->dadosImagem['tmp_name']);
                $this->redimencionarImagem();
                $this->validarDiretorio();
                imagepng($this->imgRedimencionada, $this->diretorio . $this->nomeImagem);
            default:
                break;
        }
    }

    private function validarDiretorio()
    {
        if (!file_exists($this->diretorio) && !is_dir($this->diretorio)) {
            mkdir($this->diretorio, 0755);
        }
    }

    private function redimencionarImagem()
    {
        $larguraOriginal = imagesx($this->imagem);
        $alturaOriginal = imagesy($this->imagem);

        $this->imgRedimencionada = imagecreatetruecolor($this->largura, $this->altura);

        imagecopyresampled($this->imgRedimencionada, $this->imagem, 0, 0, 0, 0, $this->largura, $this->altura, $larguraOriginal, $alturaOriginal);
    }

}
