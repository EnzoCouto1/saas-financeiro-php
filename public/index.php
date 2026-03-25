<?php
// Exibe erros para nos ajudar no desenvolvimento
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../src/Models/Empresa.php';

$empresaModel = new Empresa();

// 1. Verifica se o usuário clicou no botão do formulário (Método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega o que foi digitado no campo 'nome_fantasia'
    $nomeDigitado = $_POST['nome_fantasia'] ?? '';
    
    if (!empty($nomeDigitado)) {
        // Tenta salvar no banco de dados usando o nosso Model
        if ($empresaModel->criar($nomeDigitado)) {
            $mensagem = "Empresa '$nomeDigitado' cadastrada com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao cadastrar a empresa no banco.";
            $tipoMensagem = "erro";
        }
    }
}

// 2. Busca todas as empresas atualizadas no banco de dados
$empresas = $empresaModel->listarTodas();

// 3. Carrega a tela (View) para mostrar ao usuário
// Importante: As variáveis $mensagem e $empresas que criamos acima 
// poderão ser usadas dentro desse arquivo HTML!
require_once '../src/Views/cadastro_empresa.php';