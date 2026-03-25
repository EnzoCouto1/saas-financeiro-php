<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários - SaaS Financeiro</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; color: #333; margin: 40px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input[type="text"], input[type="email"], input[type="password"], select { width: 100%; padding: 10px; margin: 10px 0 20px 0; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #218838; }
        .mensagem { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .sucesso { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .erro { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .link-voltar { display: block; text-align: center; margin-top: 15px; color: #0056b3; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Criar Acesso de Usuário</h2>
    
    <?php if (isset($mensagem)): ?>
        <div class="mensagem <?php echo $tipoMensagem; ?>">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <form action="usuarios.php" method="POST">
        <label for="empresa_id">Vincular a qual Empresa?</label>
        <select name="empresa_id" id="empresa_id" required>
            <option value="">Selecione uma empresa...</option>
            <?php foreach ($empresas as $empresa): ?>
                <option value="<?php echo $empresa['id']; ?>">
                    <?php echo htmlspecialchars($empresa['nome_fantasia']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" required placeholder="Ex: João Silva">
        
        <label for="email">E-mail de Acesso:</label>
        <input type="email" id="email" name="email" required placeholder="joao@email.com">

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required placeholder="Digite uma senha forte">
        
        <button type="submit">Cadastrar Usuário</button>
    </form>

    <a href="index.php" class="link-voltar">← Voltar para Cadastro de Empresas</a>
</div>

</body>
</html>