<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaaS Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Um fundo cinza bem claro para destacar os cartões brancos */
        body { background-color: #f4f6f9; }
        /* Sombreamento suave para os cartões */
        .card-custom { border: none; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-4" href="dashboard.php">SaaS Financeiro</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 custom-nav ms-4">
                <li class="nav-item"><a class="nav-link px-3 mx-1 rounded text-warning fw-bold" href="clientes.php">Comandas</a></li>
                <li class="nav-item"><a class="nav-link px-3 mx-1 rounded" href="produtos.php">Cardápio</a></li>
                <li class="nav-item"><a class="nav-link px-3 mx-1 rounded" href="lancamentos.php">Lançamentos</a></li>
                <li class="nav-item"><a class="nav-link px-3 mx-1 rounded" href="categorias.php">Categorias</a></li>
            </ul>
            
            <ul class="navbar-nav custom-nav">
                <li class="nav-item">
                    <a class="nav-link px-3 rounded text-danger fw-bold" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Aumenta um pouco a fonte do menu para melhor leitura */
    .custom-nav .nav-link {
        font-size: 1.1rem;
        transition: all 0.2s ease-in-out;
    }

    /* O efeito mágico quando passa o mouse (Hover) */
    .custom-nav .nav-link:hover {
        background-color: rgba(178, 33, 33, 0.61); /* Cria uma caixa com fundo levemente branco */
        transform: translateY(-2px); /* Dá uma leve levantada no botão */
        color: #ffffff !important; /* Força o texto a ficar bem branco para destacar */
    }
    
    /* Mantém a cor do botão de Sair vermelha mesmo no hover */
    .custom-nav .text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1); 
        color: #dc3545 !important;
    }
</style>

<div class="container-fluid px-4 mt-4">