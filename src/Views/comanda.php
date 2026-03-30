<?php require_once 'partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="clientes.php" class="btn btn-outline-secondary fw-bold">← Voltar</a>
        <h2 class="h3 text-secondary mb-0">Comanda: <span class="text-primary fw-bold"><?php echo htmlspecialchars($cliente['nome']); ?></span></h2>
    </div>
    
    <?php if ($cliente['status'] === 'aberto'): ?>
        <span class="badge bg-warning text-dark fs-6 px-3 py-2">Status: Aberta</span>
    <?php else: ?>
        <span class="badge bg-success fs-6 px-3 py-2">Status: Paga</span>
    <?php endif; ?>
</div>

<?php if (isset($mensagem)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $mensagem; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card card-custom h-100 border-top border-primary border-4">
            <div class="card-body">
                <h5 class="card-title text-secondary mb-4">🛒 Lançamento Rápido</h5>
                
                <form action="comanda.php?id=<?php echo $cliente_id; ?>" method="POST">
                    <input type="hidden" name="acao" value="adicionar_item">
                    
                    <input type="hidden" name="descricao" id="descricao" value="">
                    <input type="hidden" name="categoria_id" id="categoria_id" value="">
                    <input type="hidden" name="valor" id="valor" value="0">

                    <div class="mb-4">
                        <label for="produto_select" class="form-label text-muted fw-bold">1. Escolha o Produto</label>
                        <select class="form-select form-select-lg" name="produto_id" id="produto_select" required onchange="preencherProduto()">
                            <option value="">Selecione no cardápio...</option>
                            <?php foreach ($produtosCardapio as $p): ?>
                                <option value="<?php echo $p['id']; ?>" 
                                        data-preco="<?php echo $p['preco']; ?>"
                                        data-nome="<?php echo htmlspecialchars($p['nome']); ?>"
                                        data-categoria="<?php echo $p['categoria_id']; ?>">
                                    <?php echo htmlspecialchars($p['nome']); ?> — R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?> (Estoque: <?php echo $p['quantidade_estoque']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row mb-4">
                        <div class="col-4">
                            <label for="quantidade" class="form-label text-muted fw-bold">2. Qtd</label>
                            <input type="number" class="form-control form-control-lg text-center" id="quantidade" name="quantidade" value="1" min="1" onchange="preencherProduto()" onkeyup="preencherProduto()">
                        </div>
                        <div class="col-8">
                            <label class="form-label text-muted fw-bold">Total a Lançar (R$)</label>
                            <input type="text" class="form-control form-control-lg bg-light text-success fw-bold" id="valor_display" readonly placeholder="0,00">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold py-3 fs-5">+ Lançar na Conta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function preencherProduto() {
        var select = document.getElementById('produto_select');
        var qtdInput = document.getElementById('quantidade');
        var valorDisplay = document.getElementById('valor_display');
        var valorInput = document.getElementById('valor');
        var descInput = document.getElementById('descricao');
        var catInput = document.getElementById('categoria_id');

        if (select.value === "") {
            valorDisplay.value = "";
            valorInput.value = "0";
            return;
        }

        var option = select.options[select.selectedIndex];
        // Puxa o preço do data-preco
        var precoUnico = parseFloat(option.getAttribute('data-preco')); 
        var qtd = parseInt(qtdInput.value) || 1;
        var total = precoUnico * qtd;

        valorDisplay.value = "R$ " + total.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        valorInput.value = total;
        descInput.value = qtd + "x " + option.getAttribute('data-nome');
        catInput.value = option.getAttribute('data-categoria');
    }
    </script>

    
    <div class="col-md-7 mb-4">
        <div class="card card-custom h-100 bg-light border-0">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-secondary border-bottom pb-2 mb-3">🧾 Resumo da Conta</h5>
                
                <div class="table-responsive flex-grow-1">
                    <table class="table table-sm table-borderless align-middle">
                        <tbody>
                            <?php if (empty($itensConsumidos)): ?>
                                <tr><td class="text-center text-muted py-4">Nenhum consumo registrado ainda.</td></tr>
                            <?php else: ?>
                                <?php foreach ($itensConsumidos as $item): ?>
                                    <tr class="border-bottom border-light">
                                        <td class="py-2 fw-bold text-dark"><?php echo htmlspecialchars($item['descricao']); ?></td>
                                        <td class="py-2 text-end text-success fw-bold">R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></td>
                                        
                                        <?php if ($cliente['status'] === 'aberto'): ?>
                                        <td class="py-2 text-end" style="width: 40px;">
                                            <form action="comanda.php?id=<?php echo $cliente_id; ?>" method="POST" class="m-0" onsubmit="return confirm('Deseja remover este item da conta?');">
                                                <input type="hidden" name="acao" value="excluir_item">
                                                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Remover Item">❌</button>
                                            </form>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pt-3 border-top border-secondary">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-secondary mb-0">Total:</h4>
                        <h2 class="text-primary fw-bold mb-0">R$ <?php echo number_format($totalConta, 2, ',', '.'); ?></h2>
                    </div>

                    <?php if ($cliente['status'] === 'aberto'): ?>
                        <form action="comanda.php?id=<?php echo $cliente_id; ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja fechar esta conta?');">
                            <input type="hidden" name="acao" value="fechar_conta">
                            
                            <div class="mb-3">
                                <label for="forma_pagamento" class="form-label text-muted fw-bold">Como o cliente vai pagar?</label>
                                <select class="form-select form-select-lg" name="forma_pagamento" id="forma_pagamento" required <?php echo $totalConta == 0 ? 'disabled' : ''; ?>>
                                    <option value="">Selecione o pagamento...</option>
                                    <option value="PIX">💠 PIX</option>
                                    <option value="Dinheiro">💵 Dinheiro</option>
                                    <option value="Cartão de Crédito">💳 Cartão de Crédito</option>
                                    <option value="Cartão de Débito">💳 Cartão de Débito</option>
                                    <option value="Fiado / Pendente">📝 Pendura (Fiado)</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold py-3 fs-5" <?php echo $totalConta == 0 ? 'disabled' : ''; ?>>
                                💰 Receber e Fechar Conta
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-success text-center fw-bold fs-5">
                            Conta Paga via <?php echo htmlspecialchars($cliente['forma_pagamento'] ?? 'Não informada'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'partials/footer.php'; ?>