<?php require_once 'partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-secondary">Comandas / Clientes Abertos</h2>
</div>

<?php if (isset($mensagem)): ?>
    <div class="alert <?php echo $tipoMensagem === 'sucesso' ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
        <?php echo $mensagem; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card card-custom mb-5 border-top border-success border-4">
    <div class="card-body">
        <form action="clientes.php" method="POST" class="d-flex gap-3 align-items-end">
            <div class="flex-grow-1">
                <label for="nome" class="form-label text-muted fw-bold">Abrir nova conta (Nome do Cliente ou Mesa)</label>
                <input type="text" class="form-control form-control-lg" id="nome" name="nome" required placeholder="Ex: Mesa 04 ou João Silva">
            </div>
            <div>
                <button type="submit" class="btn btn-success btn-lg px-4 fw-bold">+ Abrir Comanda</button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    <?php if (empty($clientes)): ?>
        <div class="col-12 text-center text-muted py-5">
            Nenhuma comanda ativa ou fechada recentemente.
        </div>
    <?php else: ?>
        <?php foreach ($clientes as $c): ?>
            <?php 
                // Verifica se a conta já foi paga para mudar a cor do card
                $isPago = $c['status'] === 'pago'; 
            ?>
            <div class="col-md-4 col-lg-3">
                <a href="comanda.php?id=<?php echo $c['id']; ?>" class="text-decoration-none text-dark">
                    <div class="card card-custom h-100 border-start <?php echo $isPago ? 'border-secondary opacity-75' : 'border-primary'; ?> border-4 tr-hover">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-truncate mb-3"><?php echo htmlspecialchars($c['nome']); ?></h5>
                            
                            <?php if ($isPago): ?>
                                <span class="badge bg-secondary mb-2">Paga (Fechada)</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark mb-2">Conta Aberta</span>
                            <?php endif; ?>
                            
                            <hr>
                            
                            <p class="text-muted mb-0 small">Total Consumido:</p>
                            <h4 class="<?php echo $isPago ? 'text-secondary' : 'text-primary'; ?> fw-bold mb-0">
                                R$ <?php echo number_format($c['total_conta'], 2, ',', '.'); ?>
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
    /* Efeito para o card levantar um pouquinho quando passar o mouse */
    .tr-hover { transition: transform 0.2s; }
    .tr-hover:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); cursor: pointer; }
</style>

<?php require_once 'partials/footer.php'; ?>