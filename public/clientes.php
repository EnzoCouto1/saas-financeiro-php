<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/Models/Cliente.php';

$clienteModel = new Cliente();
$empresa_id = $_SESSION['empresa_id'];

// Processa a abertura de uma nova comanda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';

    if (!empty($nome)) {
        if ($clienteModel->criar($empresa_id, $nome)) {
            $mensagem = "Comanda aberta para '$nome' com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao abrir a comanda.";
            $tipoMensagem = "erro";
        }
    }
}

// Busca os clientes abertos e os fechados recentemente para montar os cards
$clientes = $clienteModel->listarAtivosERecentes($empresa_id);

require_once '../src/Views/clientes.php';