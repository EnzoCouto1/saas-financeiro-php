<?php require_once 'partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-secondary">🍕 Meu Cardápio / Produtos</h2>
</div>

<?php if (isset($mensagem)): ?>
    <div class="alert <?php echo $tipoMensagem === 'sucesso' ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
        <?php echo $mensagem; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-custom h-100">
            <div class="card-body">
                <h5 class="card-title mb-4">Novo Item</h5>
                <form action="produtos.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label text-muted">Nome do Produto</label>
                        <input type="text" class="form-control" id="nome" name="nome" required placeholder="Ex: Porção de Tilápia 500g">
                    </div>
                    
                    <div class="mb-3">
                        <label for="preco" class="form-label text-muted">Preço Fixo (R$)</label>
                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0.01" required placeholder="0.00">
                    </div>

                    <div class="mb-4">
                        <label for="categoria_id" class="form-label text-muted">Categoria no Caixa</label>
                        <select class="form-select" name="categoria_id" id="categoria_id" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($categoriasEntrada as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nome']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Salvar no Cardápio</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card card-custom h-100">
            <div class="card-body">
                <h5 class="card-title mb-4">Itens Disponíveis</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th class="text-end">Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($produtos)): ?>
                                <tr><td colspan="3" class="text-center text-muted py-4">Nenhum produto cadastrado no cardápio.</td></tr>
                            <?php else: ?>
                                <?php foreach ($produtos as $p): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo htmlspecialchars($p['nome']); ?></td>
                                        <td><span class="badge bg-secondary"><?php echo htmlspecialchars($p['categoria_nome']); ?></span></td>
                                        <td class="text-end fw-bold text-success">R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'partials/footer.php'; ?>