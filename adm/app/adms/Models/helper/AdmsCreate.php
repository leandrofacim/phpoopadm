<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

use Exception;

class AdmsCreate extends AdmsConn
{
    private string $tabela;
    private array $dados;
    private $query;
    private $conn;
    private $resultado;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function create(string $tabela, array $dados): void
    {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    private function getInstrucao(): void
    {
        $colunas = implode(', ', array_keys($this->dados));
        $valores = ':' . implode(', :', array_keys($this->dados));
        $this->query = "INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$valores})";
    }

    private function executarInstrucao(): void
    {
        $this->conexao();

        try {
            $this->query->execute($this->dados);
            $this->resultado = $this->conn->lastInsertId();
        } catch (Exception $ex) {
            $this->resultado = null;
        }
    }

    private function conexao(): void
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}
