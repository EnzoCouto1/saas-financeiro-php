<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresa - SaaS Financeiro</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; color: #333; margin: 40px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input[type="text"] { width: 100%; padding: 10px; margin: 10px 0 20px 0; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #004494; }
        .mensagem { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .sucesso { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .erro { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Novo Inquilino (SaaS)</h2>
    
    <?php if (isset($mensagem)): ?>
        <div class="mensagem <?php echo $tipoMensagem; ?>">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <label for="nome_fantasia">Nome da Empresa / Negócio:</label>
        <input type="text" id="nome_fantasia" name="nome_fantasia" required placeholder="Ex: Pescaria do Zé">
        
        <button type="submit">Cadastrar Empresa</button>
    </form>

    <hr>
    
    <h3>Empresas Cadastradas:</h3>
    <ul>
        <?php foreach ($empresas as $empresa): ?>
            <li><?php echo htmlspecialchars($empresa['nome_fantasia']); ?></li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>