<?php 
include 'header.php'; 
include 'sidebar.php'; 

// Inicializa a variável para mensagens
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/Database.php'; 
    require_once __DIR__ . '/../models/ContaModel.php';

    // Obtendo os dados do formulário
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $valor = str_replace(['R$', '.', ','], ['', '', '.'], $_POST['valor']); // Removendo R$ e formatando
    $vencimento = $_POST['vencimento'];
    $cliente_id = $_POST['cliente_id'];

    // Instanciando o modelo de Conta e cadastrando a nova conta
    $contaModel = new ContaModel();
    try {
        $sucesso = $contaModel->criarConta($descricao, $tipo, $valor, $vencimento, $cliente_id);
        if ($sucesso) {
            $mensagem = "<div class='alert alert-success'>Conta cadastrada com sucesso!</div>";
        } else {
            $mensagem = "<div class='alert alert-danger'>Erro ao cadastrar a conta. Tente novamente.</div>";
        }
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}
?>

<!-- Main Content -->
<div class="content">
    <h1>Cadastro de Conta</h1>
    <p>Preencha os detalhes abaixo para cadastrar uma nova conta.</p>

    <!-- Exibe a mensagem, se existir -->
    <?php if (!empty($mensagem)) echo $mensagem; ?>

    <form method="POST">
        <div class="row">
            <!-- Descrição -->
            <div class="col-md-6 mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>

            <!-- Tipo -->
            <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="pagar">Contas a Pagar</option>
                    <option value="receber">Contas a Receber</option>
                </select>
            </div>

            <!-- Valor -->
            <div class="col-md-6 mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" required placeholder="R$ 0,00">
            </div>

            <!-- Data de Vencimento -->
            <div class="col-md-6 mb-3">
                <label for="vencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control" id="vencimento" name="vencimento" required>
            </div>

            <!-- Cliente -->
            <div class="col-md-6 mb-3">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id" required>
                    <?php
                    // Obtendo a lista de clientes
                    require_once __DIR__ . '/../models/ClienteModel.php';
                    $clienteModel = new ClienteModel();
                    $clientes = $clienteModel->obterClientes();

                    foreach ($clientes as $cliente) {
                        echo "<option value='{$cliente['id']}'>{$cliente['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Botão para cadastrar a conta -->
        <button type="submit" class="btn btn-success">Cadastrar Conta</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<!-- Script para formatar o campo de valor -->
<script>
    document.getElementById('valor').addEventListener('input', function(e) {
        let valor = e.target.value.replace(/\D/g, '');  // Remove tudo que não for número
        valor = (valor / 100).toFixed(2);  // Divide por 100 para colocar a vírgula antes dos centavos
        valor = valor.replace(".", ",");  // Substitui ponto por vírgula
        e.target.value = 'R$ ' + valor;
    });
</script>
