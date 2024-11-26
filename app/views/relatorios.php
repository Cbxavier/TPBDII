<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- Main Content -->
<div class="content">
    <h1>Gerar Relatório de Contas</h1>
    <p>Preencha os filtros abaixo para gerar o relatório desejado.</p>

    <!-- Filtros para Relatório -->
    <form method="GET" action="relatorios.php">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">Tipo de Conta</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="receber" <?= ($_GET['tipo'] ?? '') === 'receber' ? 'selected' : '' ?>>Contas a Receber</option>
                    <option value="pagar" <?= ($_GET['tipo'] ?? '') === 'pagar' ? 'selected' : '' ?>>Contas a Pagar</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?= $_GET['data_inicio'] ?? '' ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="data_fim" class="form-label">Data de Fim</label>
                <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?= $_GET['data_fim'] ?? '' ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="a_vencer" <?= ($_GET['status'] ?? '') === 'a_vencer' ? 'selected' : '' ?>>A Vencer</option>
                    <option value="vencida" <?= ($_GET['status'] ?? '') === 'vencida' ? 'selected' : '' ?>>Vencida</option>
                    <option value="paga" <?= ($_GET['status'] ?? '') === 'paga' ? 'selected' : '' ?>>Paga</option>
                    <option value="recebida" <?= ($_GET['status'] ?? '') === 'recebida' ? 'selected' : '' ?>>Recebida</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Gerar Relatório</button>
    </form>

    <div class="mt-4">
        <a href="exportar_pdf.php?<?= http_build_query($_GET) ?>" class="btn btn-danger">Exportar para PDF</a>
    </div>

    <!-- Relatório -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
        require_once __DIR__ . '/../models/ContaModel.php';

        $tipo = $_GET['tipo'] ?? '';
        $data_inicio = $_GET['data_inicio'] ?? '';
        $data_fim = $_GET['data_fim'] ?? '';
        $status = $_GET['status'] ?? '';

        // Debug dos parâmetros
        // echo "<pre>Parâmetros recebidos:";
        // print_r($_GET);
        // echo "</pre>";

        $contaModel = new ContaModel();
        $relatorio = $contaModel->obterRelatorio($tipo, $data_inicio, $data_fim, $status);

        // Debug do resultado
        // echo "<pre>Dados retornados do modelo:";
        // print_r($relatorio);
        // echo "</pre>";
    ?>
        <h2 class="mt-5">Relatório de Contas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($relatorio) > 0): ?>
                    <?php foreach ($relatorio as $conta): ?>
                        <tr>
                            <td><?= htmlspecialchars($conta['nome_cliente']); ?></td>
                            <td><?= date("d/m/Y", strtotime($conta['vencimento'])); ?></td>
                            <td>R$ <?= number_format($conta['valor'], 2, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($conta['descricao']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhuma conta encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
