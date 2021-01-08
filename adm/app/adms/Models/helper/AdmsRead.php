<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

use PDO;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

/**
 * Description of AdmsRead
 *
 * copyrigt (c) year, Leandro Facim
 */
class AdmsRead extends AdmsConn
{
    private $select;
    private $values;
    private $resultado;
    private $query;
    private $conn;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function exeRead($tabela, $termos = null, $parseString = null)
    {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->select = "SELECT * FROM {$tabela} {$termos}";

        $this->exeInstrucao();
    }

    public function fullRead(string $query, $parseString = null)
    {
        $this->select = $query;

        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }

        $this->exeInstrucao();
    }

    private function exeInstrucao()
    {
        $this->conexao();

        try {
            $this->getInstrucao();
            $this->query->execute();
            $this->resultado = $this->query->fetchAll();
        } catch (\Exception $ex) {
            $this->resultado = null;
        }
    }

    private function conexao()
    {
        $this->conn = $this->getConn();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getInstrucao()
    {
        if ($this->values) {
            foreach ($this->values as $link => $valor) {
                if ($link === 'limit' || $link === 'offset') {
                    $valor = (int) $valor;
                }
                $this->query->bindValue(":{$link}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
