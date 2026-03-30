<?php
session_start();

// Se já estiver logado, não tem por que se registrar de novo
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

require_once '../src/Models/Empresa.php';
require_once '../src/Models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_empresa = $_POST['nome_empresa'] ?? '';
    $nome_usuario = $_POST['nome_usuario'] ?? '';
    $email        = $_POST['email'] ?? '';
    $senha        = $_POST['senha'] ?? '';

    if (!empty($nome_empresa) && !empty($nome_usuario) && !empty($email) && !empty($senha)) {
        $empresaModel = new Empresa();
        $usuarioModel = new Usuario();

        // 1. Cria a empresa e pega o ID novo
        $empresa_id = $empresaModel->criar($nome_empresa);

        if ($empresa_id) {
            // 2. Cria o usuário vinculado a essa empresa
            if ($usuarioModel->criar($empresa_id, $nome_usuario, $email, $senha)) {
                // Registro concluído com sucesso! Manda pro login com uma mensagem de sucesso na sessão
                $_SESSION['mensagem_sucesso'] = "Conta criada com sucesso! Faça seu login.";
                header("Location: login.php");
                exit;
            } else {
                $erro = "Erro ao criar usuário. O e-mail já pode estar em uso.";
            }
        } else {
            $erro = "Erro ao criar a empresa.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}

// Carrega a tela
require_once '../src/Views/registro.php';