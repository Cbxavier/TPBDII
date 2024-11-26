<?php

require_once 'Database.php';

class ContaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();  // Conectar com o banco de dados
    }

    public function criarConta($descricao, $tipo, $valor, $vencimento, $cliente_id)
    {
        $query = "INSERT INTO Contas (descricao, tipo, valor, data_vencimento, cliente_id) 
                  VALUES (:descricao, :tipo, :valor, :vencimento, :cliente_id)";
        $stmt = $this->db->getConnection()->prepare($query);

        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':vencimento', $vencimento);
        $stmt->bindParam(':cliente_id', $cliente_id);

        return $stmt->execute();
    }

    public function obterContas()
    {
        $query = "SELECT * FROM Contas";
        $stmt = $this->db->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterRelatorio($tipo, $data_inicio, $data_fim, $status)
    {
        $query = "SELECT 
                    clientes.nome AS nome_cliente, 
                    Contas.data_vencimento AS vencimento,  -- Corrigido para 'data_vencimento'
                    Contas.valor, 
                    Contas.descricao 
                FROM Contas 
                INNER JOIN clientes ON Contas.cliente_id = clientes.id
                WHERE Contas.tipo = :tipo
                AND Contas.data_vencimento BETWEEN :data_inicio AND :data_fim  -- Corrigido para 'data_vencimento'
                AND Contas.status = :status";

        $stmt = $this->db->getConnection()->prepare($query);

        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':data_fim', $data_fim);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obterTotalContas($tipo)
    {
        $query = "SELECT SUM(valor) AS total FROM Contas WHERE tipo = :tipo AND status != 'paga'"; // Exclui contas pagas
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;  // Retorna 0 caso não haja resultados
    }

}
