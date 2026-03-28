<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/Models/Transacao.php';

$nome_usuario = $_SESSION['nome_usuario'];
$empresa_id = $_SESSION['empresa_id'];

$transacaoModel = new Transacao();

// Puxa a matemática que acabamos de criar no Model
$resumo = $transacaoModel->calcularResumo($empresa_id);

// Pega apenas as 5 últimas transações para mostrar um resumo rápido na tela inicial
$todasTransacoes = $transacaoModel->listarPorEmpresa($empresa_id);
$ultimasTransacoes = array_slice($todasTransacoes, 0, 5);

require_once '../src/Views/dashboard.php';