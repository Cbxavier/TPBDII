<?php include 'header.php'; ?>
<?php
// Incluir o modelo para buscar dados
require_once __DIR__ . '/../models/ContaModel.php';
require_once __DIR__ . '/../models/ClienteModel.php';

// Criar instâncias dos modelos
$contaModel = new ContaModel();
$clienteModel = new ClienteModel();

// Buscar o total de clientes
$totalClientes = $clienteModel->contarClientes();

// Buscar o total de contas a pagar
$totalContasPagar = $contaModel->obterTotalContas('pagar');

// Buscar o total de contas a receber
$totalContasReceber = $contaModel->obterTotalContas('receber');

?>

<div class="container-fluid">
    <div class="row">
        <!-- Barra Lateral -->
        <div class="col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-9 content">
            <h1>Seja Bem-Vindo!</h1>
            <p>Acompanhe os principais dados do sistema:</p>

            <!-- Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Clientes</h5>
                            <p class="card-text">Total cadastrados: <?= number_format($totalClientes, 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Contas a Pagar</h5>
                            <p class="card-text">Total: R$ <?= number_format($totalContasPagar, 2, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Contas a Receber</h5>
                            <p class="card-text">Total: R$ <?= number_format($totalContasReceber, 2, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Resumo Financeiro</h5>
                            <canvas id="financeChart" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Contas a Pagar', 'Contas a Receber'],
            datasets: [{
                label: 'Resumo Financeiro',
                data: [<?= $totalContasPagar ?>, <?= $totalContasReceber ?>], // Dados reais do PHP
                backgroundColor: ['#dc3545', '#28a745'],
                borderColor: ['#dc3545', '#28a745'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
