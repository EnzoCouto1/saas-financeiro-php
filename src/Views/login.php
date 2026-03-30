<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SaaS Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="text-center mb-4 text-primary fw-bold">📊 SaaS Financeiro</h3>

    <?php 
    if (isset($_SESSION['mensagem_sucesso'])) {
        echo '<div class="alert alert-success">' . $_SESSION['mensagem_sucesso'] . '</div>';
        unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem depois de mostrar
    }
    ?>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label text-muted">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-4">
            <label for="senha" class="form-label text-muted">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Entrar</button>

        <div class="text-center mt-3">
            <a href="registro.php" class="text-decoration-none">Não tem uma conta? Cadastre-se</a>
        </div>
    </form>
</div>

</body>
</html>