<?php
require_once __DIR__ . '/../models/ContaModel.php';

class CadastrarContaController
{
    public function cadastrarConta()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Coletar dados do formulário
            $descricao = $_POST['descricao'];
            $tipo = $_POST['tipo'];
            $valor = $_POST['valor'];
            $vencimento = $_POST['vencimento'];
            $cliente_id = $_POST['cliente_id'];

            // Ajustar o valor (remover R$ e vírgula)
            $valor = str_replace(['R$', '.', ','], '', $valor);

            // Criar instância do modelo Conta
            $contaModel = new ContaModel();

            // Chamar o método para cadastrar a conta
            $contaModel->criarConta($descricao, $tipo, $valor, $vencimento, $cliente_id);

            // Redirecionar após o cadastro
           //header('Location: ../views/lista_contas.php');
            echo 'Cadastrado com sucesso';
            exit();
        }
    }
}

// Instância do controlador para processar o cadastro
$controller = new CadastrarContaController();
$controller->cadastrarConta();

?>
