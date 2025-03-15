<?php
include "template/header.php";
session_start();
include 'db.php'; // Arquivo que faz a conexão com o banco de dados

if (!isset($_SESSION['produtor_id'])) {
    header("Location: login.php");
    exit();
}

$produtor_id = $_SESSION['produtor_id'];

// Adiciona um novo produto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adicionar_produto'])) {
    $nome_produto = mysqli_real_escape_string($conn, $_POST['nome_produto']);
    $descricao_produto = mysqli_real_escape_string($conn, $_POST['descricao_produto']);
    $preco_produto = mysqli_real_escape_string($conn, $_POST['preco_produto']);

    // Upload de imagem do produto
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagem_produto"]["name"]);

    if (move_uploaded_file($_FILES["imagem_produto"]["tmp_name"], $target_file)) {
        // Insere o produto no banco de dados com o caminho da imagem
        $query = "INSERT INTO produtos (produtor_id, nome, descricao, preco, imagem) VALUES ('$produtor_id', '$nome_produto', '$descricao_produto', '$preco_produto', '$target_file')";
        if (mysqli_query($conn, $query)) {
            echo "Produto adicionado com sucesso.";
        } else {
            echo "Erro ao adicionar o produto. Tente novamente.";
        }
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}

// Atualiza um produto existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_produto'])) {
    $produto_id = $_POST['produto_id'];
    $nome_produto = mysqli_real_escape_string($conn, $_POST['nome_produto']);
    $descricao_produto = mysqli_real_escape_string($conn, $_POST['descricao_produto']);
    $preco_produto = mysqli_real_escape_string($conn, $_POST['preco_produto']);

    // Atualiza a imagem do produto se uma nova imagem for enviada
    if (!empty($_FILES["imagem_produto"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imagem_produto"]["name"]);

        if (move_uploaded_file($_FILES["imagem_produto"]["tmp_name"], $target_file)) {
            $query = "UPDATE produtos SET nome='$nome_produto', descricao='$descricao_produto', preco='$preco_produto', imagem='$target_file' WHERE id='$produto_id' AND produtor_id='$produtor_id'";
        } else {
            echo "Desculpe, houve um erro ao enviar seu arquivo.";
        }
    } else {
        $query = "UPDATE produtos SET nome='$nome_produto', descricao='$descricao_produto', preco='$preco_produto' WHERE id='$produto_id' AND produtor_id='$produtor_id'";
    }

    if (mysqli_query($conn, $query)) {
        echo "Produto atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o produto. Tente novamente.";
    }
}

// Obtém os produtos do produtor
$query = "SELECT * FROM produtos WHERE produtor_id = '$produtor_id'";
$result = mysqli_query($conn, $query);
$produtos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos - Feira dos Produtores Rurais</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">Editar Produtos</h2>

        <form method="post" action="editar.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome_produto">Nome do Produto</label>
                <input type="text" class="form-control caixa" id="nome_produto" name="nome_produto" required>
            </div>
            <div class="form-group">
                <label for="descricao_produto">Descrição do Produto</label>
                <textarea class="form-control caixa" id="descricao_produto" name="descricao_produto" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco_produto">Preço do Produto</label>
                <input type="text" class="form-control caixa" id="preco_produto" name="preco_produto" required>
            </div>
            <div class="form-group">
                <label for="imagem_produto">Imagem do Produto</label>
                <input type="file" class="form-control caixa" id="imagem_produto" name="imagem_produto" required>
            </div>
            <button type="submit" name="adicionar_produto" class="btn btn-primary">Adicionar Produto</button>
        </form>

        <hr>

        <h3>Seus Produtos</h3>
        <div class="row">
            <?php foreach ($produtos as $produto): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                            <p class="card-text"><?php echo $produto['descricao']; ?></p>
                            <p class="card-text">Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#editModal<?php echo $produto['id']; ?>">Editar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal de Edição -->
                <div class="modal fade" id="editModal<?php echo $produto['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $produto['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?php echo $produto['id']; ?>">Editar Produto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="editar.php" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                    <div class="form-group">
                                        <label for="nome_produto<?php echo $produto['id']; ?>">Nome do Produto</label>
                                        <input type="text" class="form-control" id="nome_produto<?php echo $produto['id']; ?>" name="nome_produto" value="<?php echo $produto['nome']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descricao_produto<?php echo $produto['id']; ?>">Descrição do Produto</label>
                                        <textarea class="form-control" id="descricao_produto<?php echo $produto['id']; ?>" name="descricao_produto" required><?php echo $produto['descricao']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="preco_produto<?php echo $produto['id']; ?>">Preço do Produto</label>
                                        <input type="text" class="form-control" id="preco_produto<?php echo $produto['id']; ?>" name="preco_produto" value="<?php echo $produto['preco']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagem_produto<?php echo $produto['id']; ?>">Imagem do Produto</label>
                                        <input type="file" class="form-control" id="imagem_produto<?php echo $produto['id']; ?>" name="imagem_produto">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="editar_produto" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include "template/footer.php"; ?>
