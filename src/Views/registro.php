<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua Conta - SaaS Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .registro-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
    </style>
</head>
<body>

<div class="registro-box">
    <h3 class="text-center mb-4 text-primary fw-bold">🚀 Comece Agora</h3>
    <p class="text-center text-muted mb-4">Crie a conta do seu negócio e tenha controle total.</p>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form action="registro.php" method="POST">
        <h5 class="mb-3 text-secondary">Dados do Negócio</h5>
        <div class="mb-3">
            <label for="nome_empresa" class="form-label text-muted">Nome da Empresa / Projeto</label>
            <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" required placeholder="Ex: Pescaria e Lazer">
        </div>

        <hr class="my-4">
        
        <h5 class="mb-3 text-secondary">Seu Acesso</h5>
        <div class="mb-3">
            <label for="nome_usuario" class="form-label text-muted">Seu Nome Completo</label>
            <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-muted">E-mail Profissional</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="seu@email.com">
        </div>

        <div class="mb-4">
            <label for="senha" class="form-label text-muted">Crie uma Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Criar Minha Conta</button>
        
        <div class="text-center mt-3">
            <a href="login.php" class="text-decoration-none">Já tem uma conta? Faça login aqui.</a>
        </div>
    </form>
</div>

</body>
</html>