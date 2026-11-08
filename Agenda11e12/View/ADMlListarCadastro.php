<?php
if (!isset($dadosUsuario)) {
    header("Location: index.php?acao=ADMListarCadastrados");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Cadastro</title>
    <!-- Inclua seus arquivos CSS e layout principal aqui -->
</head>
<body>
    <div class="container mt-4">
        <h2>Detalhes do Usuário</h2>
        <hr>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?php echo $dadosUsuario['id']; ?></p>
                <p><strong>Nome:</strong> <?php echo $dadosUsuario['nome']; ?></p>
                <p><strong>E-mail:</strong> <?php echo $dadosUsuario['email']; ?></p>
                <!-- Adicione os demais campos conforme a sua tabela de usuários -->
            </div>
        </div>
        
        <br>
        <a href="index.php?acao=ADMListarCadastrados" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>