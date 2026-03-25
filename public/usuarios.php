<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Importamos os dois Models, pois precisamos listar as empresas e salvar o usuário
require_once '../src/Models/Empresa.php';
require_once '../src/Models/Usuario.php';

$empresaModel = new Empresa();
$usuarioModel = new Usuario();

// 1. Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegamos os dados do formulário
    $empresa_id = $_POST['empresa_id'] ?? null;
    $nome       = $_POST['nome'] ?? '';
    $email      = $_POST['email'] ?? '';
    $senha      = $_POST['senha'] ?? '';
    
    // Validação básica para garantir que nada veio vazio
    if (!empty($empresa_id) && !empty($nome) && !empty($email) && !empty($senha)) {
        
        // Tentamos criar o usuário (lembre-se: a senha será encriptada dentro do Model!)
        if ($usuarioModel->criar($empresa_id, $nome, $email, $senha)) {
            $mensagem = "Usuário <strong>$nome</strong> criado com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao criar usuário. Este e-mail pode já estar cadastrado.";
            $tipoMensagem = "erro";
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos.";
        $tipoMensagem = "erro";
    }
}

// 2. Buscamos todas as empresas para preencher o <select> da tela
$empresas = $empresaModel->listarTodas();

// 3. Carregamos a View
require_once '../src/Views/cadastro_usuario.php';