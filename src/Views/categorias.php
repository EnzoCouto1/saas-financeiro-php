<?php require_once 'partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-secondary">Gerenciar Categorias</h2>
</div>

<?php if (isset($mensagem)): ?>
    <div class="alert <?php echo $tipoMensagem === 'sucesso' ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
        <?php echo $mensagem; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title mb-4">Nova Categoria</h5>
                <form action="categorias.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label text-muted">Nome da Categoria</label>
                        <input type="text" class="form-control" id="nome" name="nome" required placeholder="Ex: Fornecedores">
                    </div>
                    
                    <div class="mb-4">
                        <label for="tipo" class="form-label text-muted">Tipo de Movimentação</label>
                        <select class="form-select" name="tipo" id="tipo" required>
                            <option value="">Selecione...</option>
                            <option value="Entrada">Entrada (Receita)</option>
                            <option value="Saida">Saída (Despesa)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Salvar Categoria</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title mb-4">Categorias Cadastradas</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($categorias)): ?>
                                <tr><td colspan="2" class="text-center text-muted py-3">Nenhuma categoria cadastrada.</td></tr>
                            <?php else: ?>
                                <?php foreach ($categorias as $cat): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo htmlspecialchars($cat['nome']); ?></td>
                                        <td>
                                            <?php if ($cat['tipo'] === 'Entrada'): ?>
                                                <span class="badge bg-success">Entrada</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Saída</span>
                                            <?php endif; ?>
                                        </td>
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