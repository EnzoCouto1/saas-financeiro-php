<?php require_once 'partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-secondary">Registrar Lançamento</h2>
</div>

<?php if (isset($mensagem)): ?>
    <div class="alert <?php echo $tipoMensagem === 'sucesso' ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
        <?php echo $mensagem; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card card-custom mb-4 border-top border-primary border-4">
    <div class="card-body p-4">
        <form action="lancamentos.php" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="descricao" class="form-label text-muted">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" required placeholder="Ex: Pagamento de Fornecedor">
                </div>
                
                <div class="col-md-3">
                    <label for="valor" class="form-label text-muted">Valor (R$)</label>
                    <input type="number" class="form-control" id="valor" name="valor" step="0.01" min="0.01" required placeholder="0.00">
                </div>

                <div class="col-md-3">
                    <label for="data_transacao" class="form-label text-muted">Data</label>
                    <input type="date" class="form-control" id="data_transacao" name="data_transacao" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="col-md-4">
                    <label for="tipo" class="form-label text-muted">Tipo</label>
                    <select class="form-select" name="tipo" id="tipo" required>
                        <option value="">Selecione...</option>
                        <option value="Entrada">Entrada (Receita)</option>
                        <option value="Saida">Saída (Despesa)</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="categoria_id" class="form-label text-muted">Categoria</label>
                    <select class="form-select" name="categoria_id" id="categoria_id" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>">
                                <?php echo htmlspecialchars($cat['nome']); ?> (<?php echo $cat['tipo']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100 fw-bold">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <h5 class="card-title mb-4">Extrato de Movimentações</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th class="text-end">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transacoes)): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Nenhum lançamento encontrado.</td></tr>
                    <?php else: ?>
                        <?php foreach ($transacoes as $t): ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($t['data_transacao'])); ?></td>
                                <td><strong><?php echo htmlspecialchars($t['descricao']); ?></strong></td>
                                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($t['categoria_nome']); ?></span></td>
                                <td class="text-end fw-bold <?php echo $t['tipo'] === 'Entrada' ? 'text-success' : 'text-danger'; ?>">
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