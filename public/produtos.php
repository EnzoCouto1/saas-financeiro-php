<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/Models/Produto.php';
require_once '../src/Models/Categoria.php';

$produtoModel = new Produto();
$categoriaModel = new Categoria();
$empresa_id = $_SESSION['empresa_id'];

// Processa o cadastro de um novo item no cardápio
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = str_replace(',', '.', $_POST['preco'] ?? '0');
    $categoria_id = $_POST['categoria_id'] ?? '';

    if (!empty($nome) && $preco > 0 && !empty($categoria_id)) {
        if ($produtoModel->criar($empresa_id, $nome, $preco, $categoria_id)) {
            $mensagem = "Item adicionado ao cardápio com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao adicionar item.";
            $tipoMensagem = "erro";
        }
    }
}

// Busca as categorias (para você vincular, ex: Cerveja na categoria 'Bebidas')
$todasCategorias = $categoriaModel->listarPorEmpresa($empresa_id);
$categoriasEntrada = array_filter($todasCategorias, function($cat) {
    return $cat['tipo'] === 'Entrada';
});

// Busca os itens já cadastrados
$produtos = $produtoModel->listarPorEmpresa($empresa_id);

require_once '../src/Views/produtos.php';