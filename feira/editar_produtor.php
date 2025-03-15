<?php
session_start();
if (!isset($_SESSION['produtor_id']) || !$_SESSION['is_master']) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$produtor_id = null;
$produtor = null;
$produtos = [];
$sucesso = $erro = "";

// Obtém os dados do produtor e seus produtos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produtor_id'])) {
    $produtor_id = intval($_POST['produtor_id']);
    
    // Obtém os dados do produtor
    $query = "SELECT * FROM produtores WHERE id = $produtor_id";
    $result = mysqli_query($conn, $query);
    $produtor = mysqli_fetch_assoc($result);

    // Obtém os produtos do produtor
    $query = "SELECT * FROM produtos WHERE produtor_id = $produtor_id";
    $result = mysqli_query($conn, $query);
    $produtos = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Atualiza os dados do produtor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    $produtor_id = intval($_POST['produtor_id']);
    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $descricao = htmlspecialchars($_POST['descricao']);

    $update_query = "UPDATE produtores SET nome='$nome', email='$email', descricao='$descricao' WHERE id=$produtor_id";
    if (mysqli_query($conn, $update_query)) {
        $sucesso = "Dados do produtor atualizados com sucesso.";
    } else {
        $erro = "Erro ao atualizar os dados do produtor. Tente novamente.";
    }
}

// Atualiza os produtos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produtos'])) {
    foreach ($_POST['produtos'] as $produto_id => $produto) {
        $nome_produto = htmlspecialchars($produto['nome']);
        $descricao_produto = htmlspecialchars($produto['descricao']);
        $preco_produto = floatval($produto['preco']);

        $update_query = "UPDATE produtos SET nome='$nome_produto', descricao='$descricao_produto', preco='$preco_produto' WHERE id=$produto_id AND produtor_id=$produtor_id";
        if (!mysqli_query($conn, $update_query)) {
            $erro = "Erro ao atualizar o produto ID $produto_id. Tente novamente.";
        } else {
            $sucesso = "Dados do produtor e produtos atualizados com sucesso.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtor - Feira de Produtores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/editar_produtor.css">
</head>
<body>
    <?php include "template/header.php"; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Produtor</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($sucesso): ?>
                    <div class="alert alert-success"><?php echo $sucesso; ?></div>
                <?php elseif ($erro): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                <?php endif; ?>
                <?php if ($produtor): ?>
                    <form method="post" action="editar_produtor.php">
                        <input type="hidden" name="produtor_id" value="<?php echo $produtor['id']; ?>">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produtor['nome']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $produtor['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?php echo $produtor['descricao']; ?></textarea>
                        </div>

                        <h3 class="mt-4">Editar Produtos</h3>
                        <?php foreach ($produtos as $produto): ?>
                            <div class="mb-3 border rounded p-3">
                                <input type="hidden" name="produtos[<?php echo $produto['id']; ?>][id]" value="<?php echo $produto['id']; ?>">
                                <label for="produto-nome-<?php echo $produto['id']; ?>" class="form-label">Nome do Produto</label>
                                <input type="text" class="form-control" id="produto-nome-<?php echo $produto['id']; ?>" name="produtos[<?php echo $produto['id']; ?>][nome]" value="<?php echo $produto['nome']; ?>" required>
                                
                                <label for="produto-descricao-<?php echo $produto['id']; ?>" class="form-label">Descrição do Produto</label>
                                <textarea class="form-control" id="produto-descricao-<?php echo $produto['id']; ?>" name="produtos[<?php echo $produto['id']; ?>][descricao]" rows="2" required><?php echo $produto['descricao']; ?></textarea>
                                
                                <label for="produto-preco-<?php echo $produto['id']; ?>" class="form-label">Preço do Produto</label>
                                <input type="text" class="form-control" id="produto-preco-<?php echo $produto['id']; ?>" name="produtos[<?php echo $produto['id']; ?>][preco]" value="<?php echo $produto['preco']; ?>" required>
                            </div>
                        <?php endforeach; ?>
                        
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning">Produtor não encontrado.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
 
    <?php include "template/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
