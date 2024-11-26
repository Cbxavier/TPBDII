<?php
// Habilitar exibição de erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluir o cabeçalho e outros arquivos necessários
include 'header.php'; 
include 'sidebar.php'; 

?>

<!-- Main Content -->
<div class="content">
    <h1>Cadastro de Cliente</h1>
    <p>Preencha os detalhes abaixo para cadastrar um novo cliente.</p>

    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="col-md-6 mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco">
            </div>
        </div>
        
        <button type="submit" class="btn btn-success">Cadastrar Cliente</button>
    </form>

    <?php
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Verificar se os dados necessários estão presentes
        if (isset($_POST['nome']) && isset($_POST['email'])) {
            // Captura os dados do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
            $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';

            // Criar uma instância do modelo Cliente
            require_once __DIR__ . '/../models/ClienteModel.php';
            $clienteModel = new ClienteModel();

            try {
                // Chamar o método para cadastrar o cliente
                $clienteModel->criarCliente($nome, $email, $telefone, $endereco);

                // Exibir mensagem de sucesso
                echo '<p>Cliente cadastrado com sucesso!</p>';
            } catch (Exception $e) {
                // Exibir erro caso ocorra
                echo '<p style="color: red;">Erro ao cadastrar cliente: ' . $e->getMessage() . '</p>';
            }
        }
    }
    ?>
</div>

<?php include 'footer.php'; ?>
