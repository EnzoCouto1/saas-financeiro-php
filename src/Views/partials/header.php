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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">📊 SaaS Financeiro</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Painel</a></li>
                <li class="nav-item"><a class="nav-link" href="lancamentos.php">Lançamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="categorias.php">Categorias</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
                <span class="text-light me-3">
                    Olá, <strong><?php echo htmlspecialchars($_SESSION['nome_usuario'] ?? 'Usuário'); ?></strong>
                </span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
            </div>
        </div>
    </div>
</nav>

<div class="container">