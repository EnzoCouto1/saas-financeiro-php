<?php
session_start();

// Barreira de segurança: se não tiver logado, volta pro login!
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/Models/Categoria.php';

$categoriaModel = new Categoria();
$empresa_id = $_SESSION['empresa_id'];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    if (!empty($nome) && !empty($tipo)) {
        if ($categoriaModel->criar($empresa_id, $nome, $tipo)) {
            $mensagem = "Categoria '$nome' salva com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao salvar a categoria.";
            $tipoMensagem = "erro";
        }
    } else {
        $mensagem = "Por favor, preencha o nome e o tipo.";
        $tipoMensagem = "erro";
    }
}

// Busca as categorias para listar na tela
$categorias = $categoriaModel->listarPorEmpresa($empresa_id);

// Carrega a interface visual
require_once '../src/Views/categorias.php';