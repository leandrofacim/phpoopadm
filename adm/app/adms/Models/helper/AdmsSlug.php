<?php

declare (strict_types=1);

namespace App\adms\Models\helper;

/**
 * Description of AdmsSlug
 *
 * @copyright (c) year, Leandro Facim 
 */
class AdmsSlug
{
    private $nome;
    private $formato;
    
    public function nomeSulg(string $nome)
    {
        $this->nome = $nome;
        $this->formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
        $this->nome = strtr(utf8_decode($this->nome), utf8_decode($this->formato['a']), $this->formato['b']);
        $this->nome = strip_tags($this->nome);
        $this->nome = str_replace(' ', '-', $this->nome);
        $this->nome = str_replace(array('-----', '----', '---', '--'), '-', $this->nome);
        $this->nome = strtolower($this->nome);
        
        return $this->nome;
    }
}
