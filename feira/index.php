<?php
include "template/header.php";
include "db.php"; // Arquivo que faz a conexão com o banco de dados

$query = "SELECT * FROM produtores";
$result = mysqli_query($conn, $query);
$produtores = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feira de Produtores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
<body>

    <!-- Carrossel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/lagoa1.jpg" class="d-block w-100" alt="Milho">
            </div>
            <div class="carousel-item">
                <img src="img/galpao.jpg" class="d-block w-100" alt="Frutas">
            </div>
            <div class="carousel-item">
                <img src="img/lagoaNoite.png" class="d-block w-100" alt="Verduras">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <!-- Seção Sobre -->
    <div class="custom-divider"></div> <!-- Linha acima do título -->

    <div class="about-section">
        <h2 class="verde">Sobre a Feira</h2>
        <p>A Feira de Produtores Rurais promove o melhor da produção local, conectando a comunidade ao campo.</p>
        <p>Venha conhecer e apoiar os nossos produtores locais!</p>
        <a href="sobre.php" class="btn btn-success">Saiba Mais</a>
        <br><br>
        
        <!-- Linha decorativa com fade -->
        <div class="custom-divider"></div>
    </div>

    <div class="container">
        <h1 class="text-center">Feira dos Produtores Rurais de Patos de Minas</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($produtores as $produtor): ?>
                <div class="col">
                    <div class="card h-100">
                        <a href="produtor.php?produtor_id=<?php echo $produtor['id']; ?>">
                            <img src="<?php echo $produtor['imagem']; ?>" class="card-img-top" alt="<?php echo $produtor['nome']; ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produtor['nome']; ?></h5>
                            <p class="card-text"><?php echo $produtor['descricao']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Linha decorativa antes do rodapé -->
    <div class="custom-divider"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include "template/footer.php"; ?>
