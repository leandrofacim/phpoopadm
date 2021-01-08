<?php

declare(strict_types=1);

namespace Core;

class ConfigController
{
    private string $url;
    private array $urlConjunto;
    private string $urlController;
    private ?string $urlParametro;
    private string $urlMetodo;
    private string $classe;
    private array $paginas;
    private static $format = [];

    public function __construct()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {

            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->limparUrl();
            $this->urlConjunto = explode('/', $this->url);

            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->slugController($this->urlConjunto[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlConjunto[1]);
            } else {
                $this->urlMetodo = $this->slugMetodo(METODO);
            }
            if (isset($this->urlConjunto[2])) {
                $this->urlParametro = $this->urlConjunto[2];
            } else {
                $this->urlParametro = null;
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = null;
        }
    }

    /**
     * Responsável por carregar as páginas 
     * cadastradas no bando de dados,
     * 
     * @return void
     */
    public function carregar(): void
    {
        $listarPage = new \App\adms\Models\AdmsPaginas();
        $this->paginas = $listarPage->listarPaginas($this->urlController, $this->urlMetodo);

        if ($this->paginas) {
            extract($this->paginas[0]);
            $this->classe = "\\App\\{$tipo_tpg}\\Controllers\\{$this->urlController}";
            if (class_exists($this->classe)) {
                $this->carregarMetodo();
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
                $this->urlMetodo = $this->slugMetodo(METODO);
                $this->carregar();
            }
        } else {
            $this->urlController = $this->slugController('Login');
            $this->urlMetodo = $this->slugController('acesso');
            $this->carregar();
        }
    }

    /**
     * remove caracteres especiais limpando a url
     * 
     * @return void
     */
    private function limparUrl(): void
    {
        $this->url = strip_tags($this->url);

        $this->url = trim($this->url);

        $this->url = rtrim($this->url, '/');

        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode(self::$format['a']), self::$format['b']);
    }

    private function slugController(string $slugController): string
    {
        $urlController = str_replace(' ', '', ucwords(implode(
            ' ',
            explode('-', strtolower($slugController))
        )));
        return $urlController;
    }

    private function slugMetodo(string $slugMetodo): string
    {
        $urlMetodo = str_replace(' ', '', ucwords(implode(
            ' ',
            explode('-', strtolower($slugMetodo))
        )));
        return lcfirst($urlMetodo);
    }

    /**
     * Busca Metodo, validando se existe parametros.
     * se não encontrar metodo ele traz o metodo default Home
     * 
     * @return void
     */
    private function carregarMetodo(): void
    {
        $classeCarregar = new $this->classe;

        if (method_exists($classeCarregar, $this->urlMetodo)) {
            if ($this->urlParametro !== null) {
                $classeCarregar->{$this->urlMetodo}($this->urlParametro);
            } else {
                $classeCarregar->{$this->urlMetodo}();
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->carregar();
        }
    }
}
