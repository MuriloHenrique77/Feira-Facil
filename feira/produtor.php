<?php
include "template/header.php";
session_start();
include 'db.php'; // Arquivo que faz a conexão com o banco de dados

// Verifica se o ID do produtor está presente na URL
if (!isset($_GET['produtor_id'])) {
    header("Location: index.php");
    exit();
}

$produtor_id = $_GET['produtor_id'];

// Obtém as informações do produtor
$query = "SELECT * FROM produtores WHERE id = '$produtor_id'";
$result = mysqli_query($conn, $query);
$produtor = mysqli_fetch_assoc($result);

if (!$produtor) {
    echo "Produtor não encontrado.";
    exit();
}

// Obtém os produtos do produtor
$query = "SELECT * FROM produtos WHERE produtor_id = '$produtor_id'";
$result = mysqli_query($conn, $query);
$produtos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produtor['nome']; ?> - Feira de Produtores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?php echo $produtor['nome']; ?></h1>
        <div class="row mb-4">
            <div class="col-md-6 text-center">
                <img src="<?php echo $produtor['imagem']; ?>" class="img-fluid" alt="<?php echo $produtor['nome']; ?>">
            </div>
            <div class="col-md-6">
                <p class="descricao-produtor"><?php echo $produtor['descricao']; ?></p>
            </div>
        </div>

        <h2 class="text-center mb-4 verde">Produtos</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($produtos as $produto): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $produto['imagem']; ?>" class="product-img" alt="<?php echo $produto['nome']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                            <p class="card-text"><?php echo $produto['descricao']; ?></p>
                            <p class="card-text"><strong>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "template/footer.php"; ?>
