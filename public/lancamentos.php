<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/Models/Transacao.php';
require_once '../src/Models/Categoria.php';

$transacaoModel = new Transacao();
$categoriaModel = new Categoria();

$empresa_id = $_SESSION['empresa_id'];
$usuario_id = $_SESSION['usuario_id'];

// Processa o formulário de nova transação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'] ?? '';
    $valor = str_replace(',', '.', $_POST['valor'] ?? '0'); // Troca vírgula por ponto para o banco de dados
    $categoria_id = $_POST['categoria_id'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $data_transacao = $_POST['data_transacao'] ?? date('Y-m-d'); // Pega a data atual se vier vazio

    if (!empty($descricao) && $valor > 0 && !empty($categoria_id) && !empty($tipo)) {
        if ($transacaoModel->criar($empresa_id, $usuario_id, $categoria_id, $descricao, $valor, $tipo, $data_transacao)) {
            $mensagem = "Lançamento registrado com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao registrar o lançamento.";
            $tipoMensagem = "erro";
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos corretamente.";
        $tipoMensagem = "erro";
    }
}

// Busca as listas para a tela
$categorias = $categoriaModel->listarPorEmpresa($empresa_id);
$transacoes = $transacaoModel->listarPorEmpresa($empresa_id);

require_once '../src/Views/lancamentos.php';