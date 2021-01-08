<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

use Exception;

/**
 * Class Helper Responsavel por realizar update 
 */
class AdmsUpdate extends AdmsConn
{
    /** @var string armazena a tabela */
    private $tabela;

    /** @var array armazena os valores para update */
    private $dados;

    /** @var object armazena a conexão */
    private object $conn;

    private  $query;

    private  $resultado;

    /** @var string armazena as condições */
    private $termos;

    /** @var string armazena os valores para update */
    private $values;

    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Metodo de instancia, responsavel por executar
     * as instruções de update
     * 
     * @param string $tabela armazena a tabela
     * 
     * @param array $dados armazena os dados
     * 
     * @param string $termos armazena as condições
     * 
     * @param string $parseString armazena a parseString
     * 
     * @return void
     */
    public function exeUpdate(
        string $tabela,
        array $dados,
        string $termos = null,
        string $parseString = null
    ): void {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->termos = $termos;

        parse_str($parseString, $this->values);
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    /**
     * Metodo prepara os dados para serem atualizados
     * 
     * @return void
     */
    private function getInstrucao(): void
    {
        foreach ($this->dados as $key => $value) {
            $values[] = $key . '= :' . $key;
        }
        $values = implode(', ', $values);

        $this->query = "UPDATE {$this->tabela} SET {$values} {$this->termos}";
    }

    /**
     * Metodo executa a query no banco de dados
     * 
     * @return void
     */
    private function executarInstrucao(): void
    {
        $this->conexao();

        try {
            $this->query->execute(array_merge($this->dados, $this->values));
            $this->resultado = true;
        } catch (Exception $ex) {
            $this->resultado = null;
        }
    }

    /**
     * Metodo recebe a conexao e prepara a query
     * 
     * @return void
     */
    private function conexao(): void
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}
