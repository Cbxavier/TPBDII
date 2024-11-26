<?php

// Incluir a classe do modelo
require_once '../models/ClienteModel.php';

// Verificar se os dados foram enviados pelo formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados enviados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Criar uma instância do modelo Cliente
    $clienteModel = new ClienteModel();
    
    // Chamar o método para cadastrar o cliente
    $clienteModel->criarCliente($nome, $email, $telefone, $endereco);

    // Redirecionar após o cadastro (pode ser para a página de listagem de clientes ou uma página de sucesso)
    header('Location: ../views/lista_clientes.php');
    exit();
}
?>
