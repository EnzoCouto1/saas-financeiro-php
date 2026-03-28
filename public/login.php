<?php
// INICIA A SESSÃO: Isso deve ser sempre a primeira coisa no arquivo!
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../src/Models/Usuario.php';

// Se o usuário já estiver logado, manda ele direto pro painel (dashboard)
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {
        $usuarioModel = new Usuario();
        $usuarioLogado = $usuarioModel->autenticar($email, $senha);

        if ($usuarioLogado) {
            // LOGIN COM SUCESSO! Guardamos quem ele é e de qual empresa ele é
            $_SESSION['usuario_id'] = $usuarioLogado['id'];
            $_SESSION['empresa_id'] = $usuarioLogado['empresa_id'];
            $_SESSION['nome_usuario'] = $usuarioLogado['nome'];
            
            // Redireciona para o painel principal
            header("Location: dashboard.php");
            exit;
        } else {
            $erro = "E-mail ou senha incorretos.";
        }
    } else {
        $erro = "Preencha todos os campos.";
    }
}

// Carrega a tela de login
require_once '../src/Views/login.php';