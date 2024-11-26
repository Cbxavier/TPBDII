<?php

class Database
{
    private $host = 'localhost';  // Host do banco de dados
    private $dbname = 'financesModulo';  // Nome do banco de dados
    private $username = 'root';  // Nome de usuário do banco de dados
    private $password = '';  // Senha do banco de dados

    private $conn;

    // Método para criar a conexão com o banco
    public function getConnection()
    {
        if ($this->conn == null) {
            try {
                // Configura a conexão utilizando PDO
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                // Configura a manipulação de erros
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Caso ocorra erro, exibe a mensagem
                echo "Erro de conexão: " . $e->getMessage();
            }
        }
        return $this->conn;
    }
}
