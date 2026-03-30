<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/Models/Cliente.php';
require_once '../src/Models/Transacao.php';
require_once '../src/Models/Categoria.php';
require_once '../src/Models/Produto.php';

$clienteModel = new Cliente();
$transacaoModel = new Transacao();
$categoriaModel = new Categoria();
$produtoModel = new Produto();

$empresa_id = $_SESSION['empresa_id'];
$usuario_id = $_SESSION['usuario_id'];

// Pega o ID da comanda pela URL
$cliente_id = $_GET['id'] ?? null;

if (!$cliente_id) {
    header("Location: clientes.php");
    exit;
}

// Busca os dados do cliente para ter certeza que ele existe e é dessa empresa
$cliente = $clienteModel->buscarPorId($cliente_id, $empresa_id);

if (!$cliente) {
    die("Comanda não encontrada ou você não tem permissão para acessá-la.");
}

// Processa o formulário de adicionar item, excluir item ou fechar conta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'adicionar_item') {
        $produto_id = $_POST['produto_id'] ?? null;
        $quantidade = (int)($_POST['quantidade'] ?? 1);
        $descricao = $_POST['descricao'] ?? '';
        $valor = str_replace(',', '.', $_POST['valor'] ?? '0');
        $categoria_id = $_POST['categoria_id'] ?? '';
        $data_transacao = date('Y-m-d'); 

        if (!empty($descricao) && $valor > 0 && !empty($categoria_id) && $produto_id) {
            // Salva na comanda...
            if ($transacaoModel->registrarNaComanda($empresa_id, $usuario_id, $cliente_id, $categoria_id, $descricao, $valor, $data_transacao, $produto_id, $quantidade)) {
                // MÁGICA 1: Dá baixa no estoque!
                $produtoModel->movimentarEstoque($produto_id, $empresa_id, $quantidade, 'subtrair');
                $mensagem = "Item lançado e estoque atualizado!";
                $tipoMensagem = "sucesso";
            }
        }
    } elseif ($acao === 'excluir_item') {
        $item_id = $_POST['item_id'] ?? null;
        if ($item_id) {
            // Descobre qual era o produto antes de apagar
            $itemExcluido = $transacaoModel->buscarPorId($item_id, $empresa_id);
            
            if ($itemExcluido && $transacaoModel->excluirItem($item_id, $empresa_id)) {
                // MÁGICA 2: Se tinha um produto vinculado, devolve pro estoque!
                if (!empty($itemExcluido['produto_id'])) {
                    $produtoModel->movimentarEstoque($itemExcluido['produto_id'], $empresa_id, $itemExcluido['quantidade'], 'adicionar');
                }
                $mensagem = "Item removido e devolvido ao estoque!";
                $tipoMensagem = "sucesso";
            }
        }
    } elseif ($acao === 'fechar_conta') {
        $forma_pagamento = $_POST['forma_pagamento'] ?? 'Não informada';
        if ($clienteModel->fecharConta($cliente_id, $empresa_id, $forma_pagamento)) {
            header("Location: clientes.php");
            exit;
        }
    }
}
// Busca os itens consumidos para montar o "recibo" na tela
$itensConsumidos = $transacaoModel->listarPorCliente($cliente_id, $empresa_id);

// Soma o total da conta no PHP mesmo
$totalConta = 0;
foreach ($itensConsumidos as $item) {
    $totalConta += $item['valor'];
}

// Busca as categorias (apenas as de 'Entrada' fazem sentido para vender num bar)
$todasCategorias = $categoriaModel->listarPorEmpresa($empresa_id);
$categoriasEntrada = array_filter($todasCategorias, function($cat) {
    return $cat['tipo'] === 'Entrada';
});

// Busca os itens do cardápio para o menu suspenso
$produtosCardapio = $produtoModel->listarPorEmpresa($empresa_id);

require_once '../src/Views/comanda.php';