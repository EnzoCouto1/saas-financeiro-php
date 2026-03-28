<?php require_once 'partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-secondary">Visão Geral do Mês</h2>
    <a href="lancamentos.php" class="btn btn-primary">+ Novo Lançamento</a>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card card-custom h-100 border-start border-success border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase">Entradas</h6>
                <h3 class="text-success mb-0">R$ <?php echo number_format($resumo['receitas'], 2, ',', '.'); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-custom h-100 border-start border-danger border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase">Saídas</h6>
                <h3 class="text-danger mb-0">R$ <?php echo number_format($resumo['despesas'], 2, ',', '.'); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-custom h-100 border-start border-primary border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase">Saldo Atual</h6>
                <h3 class="text-primary mb-0">R$ <?php echo number_format($resumo['saldo'], 2, ',', '.'); ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white pb-0 border-0 pt-4">
        <h5 class="mb-0 text-secondary">Últimas Movimentações</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($ultimasTransacoes)): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Nenhuma movimentação recente.</td></tr>
                    <?php else: ?>
                        <?php foreach ($ultimasTransacoes as $t): ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($t['data_transacao'])); ?></td>
                                <td><strong><?php echo htmlspecialchars($t['descricao']); ?></strong></td>
                                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($t['categoria_nome']); ?></span></td>
                                <td class="fw-bold <?php echo $t['tipo'] === 'Entrada' ? 'text-success' : 'text-danger'; ?>">
                                    <?php echo $t['tipo'] === 'Entrada' ? '+' : '-'; ?> R$ <?php echo number_format($t['valor'], 2, ',', '.'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'partials/footer.php'; ?>