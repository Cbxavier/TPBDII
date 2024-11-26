<?php

require_once 'Database.php';  // Incluindo a classe Database

class ClienteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Criando instância da classe Database
    }

    public function criarCliente($nome, $email, $telefone, $endereco)
    {
        $query = "INSERT INTO clientes (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute([$nome, $email, $telefone, $endereco]);
    }

    public function obterClientes()
    {
        $query = "SELECT * FROM clientes";
        $stmt = $this->db->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarClientes()
    {
        $query = "SELECT COUNT(*) AS total FROM clientes";
        $stmt = $this->db->getConnection()->query($query);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;  // Retorna 0 caso não haja resultados
    }
}
?>
